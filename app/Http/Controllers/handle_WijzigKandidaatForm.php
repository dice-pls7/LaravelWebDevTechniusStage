<?php

namespace App\Http\Controllers;
use App\Models\Kandidaat;
use App\Http\Controllers\OverzichtsController;

$controller = new OverzichtsController();
// Maak verbinding met de database
$conn = $controller->connectToDatabase();

// Haal gegevens op uit het formulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kandidaat = new Kandidaat(
        $Id = $_POST["id"],
        $Voornaam = $_POST["Voornaam"],
        $Tussenvoegsel = $_POST["Tussenvoegsel"],
        $Achternaam = $_POST["Achternaam"],
        $Geboortedatum = $_POST["Geboortedatum"],
        $Functie = $_POST["Functie"],
        $Beschikbaarheid = $_POST["Beschikbaarheid"],
        $Beschikbaar = $_POST["Beschikbaar"],
        $Locatie = $_POST["Locatie"],
        $Taal = $_POST["Taal"],
        $Werkervaring = $_POST["Werkervaring"],
        $OudeOpdrachtgevers = $_POST["OudeOpdrachtgevers"],
        $Diplomas = $_POST["Diplomas"],
        $Certificaten = $_POST["Certificaten"],
        $FlavourText = $_POST["FlavourText"],
        $pinned = 0, // Pinned is standaard 0
        
    );
        $sql = "UPDATE kandidaat SET Voornaam='$Voornaam', Tussenvoegsel='$Tussenvoegsel', Achternaam='$Achternaam', Geboortedatum='$Geboortedatum', Functie='$Functie', Beschikbaarheid='$Beschikbaarheid', Beschikbaar='$Beschikbaar', Locatie='$Locatie', Taal='$Taal', Werkervaring='$Werkervaring', OudeOpdrachtgevers='$OudeOpdrachtgevers', Diplomas='$Diplomas', Certificaten='$Certificaten', FlavourText='$FlavourText', pinned='$pinned' WHERE Id='$Id'";
        if (mysqli_query($conn, $sql)) {
            echo "Record updated successfully";
        } else {
            echo "Error updating record: " . mysqli_error($conn);
        }
    // Sluit de database connectie
    mysqli_close($conn);
}