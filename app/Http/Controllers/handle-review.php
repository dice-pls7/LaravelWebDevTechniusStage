<?php
namespace App\Http\Controllers;
use App\Models\Reviews;
use App\Http\Controllers\OverzichtsController;

$controller = new OverzichtsController();

$conn = $controller->connectToDatabase();

// Haal gegevens op uit het formulier
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if(isset($_POST["KandidaatId"])) {

        $review = new Reviews(
            null,   
            $_POST["KandidaatId"],
            $_POST["bedrijfsnaam"],
            $_POST["review"] 
        );

        // Voeg de kandidaat toe aan de database
        $controller->insertReview($review);

        // Sluit de database connectie
        mysqli_close($conn);
    }
}