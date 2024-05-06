<?php
// include 'OverzichtsController.php';  // Include the databaseconnection.php file
namespace App\Http\Controllers;
use App\Models\Kandidaat; 
use App\Http\Controllers\OverzichtsController;
$controller = new OverzichtsController();
// Maak verbinding met de database
$conn = $controller->connectToDatabase();

// Haal gegevens op uit het formulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $kandidaat = new Kandidaat(
        null,   // Id wordt automatisch gegenereerd
        $_POST["Voornaam"],
        $_POST["Tussenvoegsel"],
        $_POST["Achternaam"],
        $_POST["Geboortedatum"],
        $_POST["Functie"],
        $_POST["Beschikbaarheid"],
        $_POST["Locatie"],
        $_POST["Taal"],
        $_POST["Werkervaring"],
        $_POST["OudeOpdrachtgevers"],
        $_POST["Diplomas"],
        $_POST["Certificaten"],
        $_POST["FlavourText"]
    );

    // Voeg de kandidaat toe aan de database
    $controller->insertKandidaat($kandidaat);

    // Sluit de database connectie
    mysqli_close($conn);
}
?>