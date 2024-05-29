<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function handleFormSubmission(Request $request)
    {
        require_once __DIR__ . '/KandidaatToevoegenController.php';
        header("Location: /overzicht");
        exit;
    }
    public function handleWijzigKandidaatForm(Request $request)
    {
        require_once __DIR__ . '/KandidaatWijzigenController.php';
        header("Location: /overzicht");
        exit;
    }
    public function handleReviewSubmission(Request $request)
    {
        require_once __DIR__ . '/ReviewToevoegenController.php';
        header("Location: /details/" . $_POST["KandidaatId"]);
        exit;
    }
    
}
?>