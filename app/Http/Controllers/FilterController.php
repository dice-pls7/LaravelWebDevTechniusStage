<?php
namespace App\Http\Controllers;

use App\Http\Controllers\OverzichtsController;
use Illuminate\Http\Request;

class FilterController extends Controller
{
    public $controller;
    public $conn;
    public function __construct()
    {
        $this->controller = new OverzichtsController();
        $this->conn = $this->controller->connectToDatabase();
    }

    public function filter()
    {
        return view('overzicht');
    }
    public function filterResults(Request $request)
    {
    $kandidaten = $this->getFilteredKandidaten($request); 

    return view('overzicht', ['kandidaten' => $kandidaten]); // Return the view with the filtered kandidaten and pinned kandidaten
    }

    public function getFilteredKandidaten(Request $request)
    {
    $kandidaten = $this->controller->getAllKandidaten();

    $filteredKandidaten = []; // Create an empty array to store the filtered kandidaten

    foreach ($kandidaten as $kandidaat) { // Loop through all kandidaten
        if ($request->filled('functie') && $kandidaat->Functie != $request->input('functie')) { // Check if the functie is set and if it matches the kandidaat's functie
            continue; // Skip the current iteration
        }
        if ($request->filled('beschikbaarheid') && $kandidaat->Beschikbaar != $request->input('beschikbaarheid')) { // Check if the beschikbaarheid is set and if it matches the kandidaat's beschikbaarheid
            continue;
        }
        $filteredKandidaten[] = $kandidaat; // Add the kandidaat to the filteredKandidaten array
    }
    return $filteredKandidaten;
    }
}
