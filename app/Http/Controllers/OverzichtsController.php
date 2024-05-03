<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kandidaat;

class OverzichtsController extends Controller
{
    private $conn;

    public function __construct()
    {
        $this->conn = $this->connectToDatabase();
    }

    public function overzicht()
    {
        $kandidaten = $this->getAllKandidaten();
        return view('overzicht', ['kandidaten' => $kandidaten]);
    }

    public function details($id)
    {
        $kandidaat = $this->getKandidaat($id);
        return view('details', ['kandidaat' => $kandidaat]);
    }
    public function delete($id) {
        $this->deleteKandidaat($id);
        return redirect()->route('overzicht');
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
    public function getAllKandidaten() {
        $sql = "SELECT * FROM kandidaat";
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
                    $row["Locatie"],
                    $row["Taal"],
                    $row["Werkervaring"],
                    $row["OudeOpdrachtgevers"],
                    $row["Diplomas"],
                    $row["Certificaten"],
                    $row["FlavourText"]
                );
                array_push($kandidaten, $kandidaat);
            }
            return $kandidaten;
        } else {
            return [];
        }
    }
    function insertKandidaat($kandidaat) {
        $sql = "INSERT INTO kandidaat (Voornaam, Tussenvoegsel, Achternaam, Geboortedatum, Functie, Beschikbaarheid, Locatie, Taal, Werkervaring, OudeOpdrachtgevers, Diplomas, Certificaten, FlavourText) 
    VALUES ('$kandidaat->voornaam', '$kandidaat->tussenvoegsel', '$kandidaat->achternaam', '$kandidaat->geboortedatum', '$kandidaat->functie', '$kandidaat->beschikbaarheid', '$kandidaat->locatie', '$kandidaat->taal', '$kandidaat->werkervaring', '$kandidaat->oudeOpdrachtgevers'
    , '$kandidaat->diplomas', '$kandidaat->certificaten', '$kandidaat->flavourText')";
    
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
    function updateKandidaat($id, $kolomNaam, $kolomWaarde) {
            // Update kandidaat, gebruik de Id om de juiste kandidaat te updaten
            // en gebruik variabelen om de nieuwe waarden op te slaan en voor de kolommen in de database tabel.
            $sql = "UPDATE kandidaat SET $kolomNaam='$kolomWaarde' WHERE Id='$id'";
    
            if (mysqli_query($this->conn, $sql)) {
                header('Location: index.php');
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
                        $row["Locatie"],
                        $row["Taal"],
                        $row["Werkervaring"],
                        $row["OudeOpdrachtgevers"],
                        $row["Diplomas"],
                        $row["Certificaten"],
                        $row["FlavourText"]
                    );
                }
            } else {
                print "No results found";
            }
            // Sluit de database connectie
            mysqli_close($this->conn);
            return $kandidaat;
        }
        
    
    function getKandidaatGegevens($conn, $Id){
        $sql = "SELECT * FROM kandidaat WHERE Id='$Id'";
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
                    $row["Locatie"],
                    $row["Taal"],
                    $row["Werkervaring"],
                    $row["OudeOpdrachtgevers"],
                    $row["Diplomas"],
                    $row["Certificaten"],
                    $row["FlavourText"]
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