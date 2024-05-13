<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kandidaat;
use App\Models\Reviews;
use Illuminate\Pagination\Paginator;
use Illuminate\Pagination\LengthAwarePaginator;


class OverzichtsController extends Controller
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connectToDatabase();
    }
    public function overzicht()
    {
        if (auth()->check()) {
            $kandidaten = DB::table('Kandidaat')->paginate(7);
            $pinnedKandidaten = $this->getAllPinnedKandidaten();
        } else {
            $kandidaten = DB::table('Kandidaat')->where('Beschikbaar', 1)->paginate(7);
            $pinnedKandidaten = $this->getAllPinnedKandidaten();
        }

        return view('overzicht', ['kandidaten' => $kandidaten, 'pinnedKandidaten' => $pinnedKandidaten]);
    }
    public function details($id)
    {
        $kandidaat = $this->getKandidaat($id);
        $reviews = $this->getReviews($id);
        return view('details', ['kandidaat' => $kandidaat], ['reviews' => $reviews]);
    }
    public function delete($id) {
        $this->deleteKandidaat($id);
        return redirect()->route('overzicht');
    }
    public function wijzigen($id) {
        $kandidaat = $this->getKandidaatGegevens($id);
        return view('wijzigen', ['kandidaat' => $kandidaat]);
    }
    public function connectToDatabase()
    {
        // Database connection
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "mydb";

        $conn = mysqli_connect($servername, $username, $password, $dbname);

        if (!$conn) {
            die("Connection failed: " . mysqli_connect_error());
        }

        return $conn;
    }
    public function getAllPinnedKandidaten() {
        $sqlPinned = "SELECT * FROM kandidaat WHERE pinned = 1";
        $resultPinned = mysqli_query($this->conn, $sqlPinned);
    
        if ($resultPinned && mysqli_num_rows($resultPinned) > 0) {
            $pinnedKandidaten = [];
            while($row = mysqli_fetch_assoc($resultPinned)) {
                $kandidaat = new Kandidaat(
                    $row["Id"],
                    $row["Voornaam"],
                    $row["Tussenvoegsel"],
                    $row["Achternaam"],
                    $row["Geboortedatum"],
                    $row["Functie"],
                    $row["Beschikbaarheid"],
                    $row["Beschikbaar"],
                    $row["Locatie"],
                    $row["Taal"],
                    $row["Werkervaring"],
                    $row["OudeOpdrachtgevers"],
                    $row["Diplomas"],
                    $row["Certificaten"],
                    $row["FlavourText"],
                    $row["pinned"]
                );
                array_push($pinnedKandidaten, $kandidaat);
            }
            return $pinnedKandidaten;
        }
        return []; // Return an empty array if no pinned kandidaten are found
    }

    public function getAllKandidaten() {

        $sql = "SELECT * FROM kandidaat WHERE pinned = 0";
        $result = mysqli_query($this->conn, $sql);


        if (mysqli_num_rows($result) > 0) {
            $kandidaten = [];
            while($row = mysqli_fetch_assoc($result)) {
                $kandidaat = new Kandidaat(
                    $row["Id"],
                    $row["Voornaam"],
                    $row["Tussenvoegsel"],
                    $row["Achternaam"],
                    $row["Geboortedatum"],
                    $row["Functie"],
                    $row["Beschikbaarheid"],
                    $row["Beschikbaar"],
                    $row["Locatie"],
                    $row["Taal"],
                    $row["Werkervaring"],
                    $row["OudeOpdrachtgevers"],
                    $row["Diplomas"],
                    $row["Certificaten"],
                    $row["FlavourText"],
                    $row["pinned"]
                );
                array_push($kandidaten, $kandidaat);
            }

        }
        return $kandidaten;
    }

    public function getReviews($kandidaatId) {
        $sql = "SELECT * FROM reviews WHERE kandidaatId='$kandidaatId'";
        $result = mysqli_query($this->conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            $reviews = [];
            while($row = mysqli_fetch_assoc($result)) {
                $review = new Reviews(
                    $row["Id"],
                    $row["KandidaatId"],
                    $row["Review"]
                );
                array_push($reviews, $review);
            }
            return $reviews;
        } else {
            return [];
        }
    }
    function insertKandidaat($kandidaat) {
        $sql = "INSERT INTO kandidaat (Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, Functie, Beschikbaarheid, Beschikbaar, Locatie, Taal, Werkervaring, OudeOpdrachtgevers, Diplomas, Certificaten, FlavourText, pinned)
    VALUES ('$kandidaat->voornaam', '$kandidaat->tussenvoegsel', '$kandidaat->achternaam', '$kandidaat->geboortedatum', '$kandidaat->functie', '$kandidaat->beschikbaarheid', '$kandidaat->beschikbaar', '$kandidaat->locatie', '$kandidaat->taal', '$kandidaat->werkervaring', '$kandidaat->oudeOpdrachtgevers'
    , '$kandidaat->diplomas', '$kandidaat->certificaten', '$kandidaat->flavourText', '$kandidaat->pinned')";

        if (mysqli_query($this->conn, $sql)) {
            header('Location: index.php');
        } else {
            print "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
        // Sluit de database connectie
        mysqli_close($this->conn);
    }
    function deleteKandidaat($id) {
        $sql = "DELETE FROM kandidaat WHERE Id=$id";

        if (mysqli_query($this->conn, $sql)) {
            print "Record deleted successfully";
        } else {
            print "Error: " . $sql . "<br>" . mysqli_error($this->conn);
        }
    }
    public function getKandidaat($id) {
        $sql = "SELECT * FROM kandidaat WHERE Id='$id'";
        $result = mysqli_query($this->conn, $sql);

        $kandidaat = null;

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                // Converteer de geboortedatum naar Nederlandse notatie
                $geboortedatum = date('d-m-Y', strtotime($row["Geboortedatum"]));

                // Converteer de beschikbaarheidsdatum naar Nederlandse notatie
                $beschikbaarheid = date('d-m-Y', strtotime($row["Beschikbaarheid"]));

                // Maak een Kandidaat object aan
                $kandidaat = new Kandidaat(
                    $row["Id"],
                    $row["Voornaam"],
                    $row["Tussenvoegsel"],
                    $row["Achternaam"],
                    $geboortedatum, // Gebruik de geconverteerde geboortedatum
                    $row["Functie"],
                    $beschikbaarheid, // Gebruik de geconverteerde beschikbaarheidsdatum
                    $row["Beschikbaar"],
                    $row["Locatie"],
                    $row["Taal"],
                    $row["Werkervaring"],
                    $row["OudeOpdrachtgevers"],
                    $row["Diplomas"],
                    $row["Certificaten"],
                    $row["FlavourText"],
                    $row["pinned"]
                );
            }
        } else {
            print "No results found";
        }
        // // Sluit de database connectie
        // mysqli_close($this->conn);
        return $kandidaat;
    }


    function getKandidaatGegevens($Id){
        $sql = "SELECT * FROM kandidaat WHERE Id='$Id'";
        $conn = $this->conn;
        $result = mysqli_query($conn, $sql);

        if (mysqli_num_rows($result) > 0) {
            while($row = mysqli_fetch_assoc($result)) {
                $kandidaat = new Kandidaat(
                    $row["Id"],
                    $row["Voornaam"],
                    $row["Tussenvoegsel"],
                    $row["Achternaam"],
                    $row["Geboortedatum"],
                    $row["Functie"],
                    $row["Beschikbaarheid"],
                    $row["Beschikbaar"],
                    $row["Locatie"],
                    $row["Taal"],
                    $row["Werkervaring"],
                    $row["OudeOpdrachtgevers"],
                    $row["Diplomas"],
                    $row["Certificaten"],
                    $row["FlavourText"],
                    $row["pinned"]
                );
            }
        } else {
            print "No results found";
        }
        // Sluit de database connectie
        mysqli_close($this->conn);
        return $kandidaat;
    }
}
