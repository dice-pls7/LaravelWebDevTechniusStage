<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class FormController extends Controller
{
    public function handleFormSubmission(Request $request)
    {
        // Include the handle_form.php file
        require_once __DIR__ . '/handle_form.php';
        header("Location: /overzicht");
        exit;
    }
    public function handleWijzigKandidaatForm(Request $request)
    {
        // Include the handle_WijzigKandidaatForm.php file
        require_once __DIR__ . '/handle_WijzigKandidaatForm.php';
        header("Location: /overzicht");
        exit;
    }
    
}
?>