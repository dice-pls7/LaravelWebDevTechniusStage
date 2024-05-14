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
    $pinnedKandidaten = $this->controller->getAllPinnedKandidaten();
    return view('overzicht', ['kandidaten' => $kandidaten, 'pinnedKandidaten' => $pinnedKandidaten]);
    }
    public function getFilteredKandidaten(Request $request)
    {
    $kandidaten = $this->controller->getAllKandidaten();

    $filteredKandidaten = []; // Create an empty array to store the filtered kandidaten

    foreach ($kandidaten as $kandidaat) { // Loop through all kandidaten
        if ($request->filled('functie') && $kandidaat->functie != $request->input('functie')) { // Check if the functie is set and if it matches the kandidaat's functie
            continue; // Skip the current iteration
        }
        if ($request->filled('beschikbaarheid') && $kandidaat->beschikbaar != $request->input('beschikbaarheid')) { // Check if the beschikbaarheid is set and if it matches the kandidaat's beschikbaarheid
            continue;
        }
        if ($request->input('werkervaring')) { // Check if the werkervaring is set
            $werkervaring = $request->input('werkervaring'); // Get the werkervaring value
            if ($werkervaring === '20+') { // Check if the werkervaring is 20+
                if ($kandidaat->werkervaring <= 20) { // Check if the kandidaat's werkervaring is less than or equal to 20
                    continue;
                }
            } else { // If the werkervaring is not 20+
                $werkervaringRange = explode('-', $werkervaring); // Split the werkervaring value into an array
                $minWerkervaring = intval($werkervaringRange[0]); // Get the minimum werkervaring
                $maxWerkervaring = intval($werkervaringRange[1]); // Get the maximum werkervaring

                if ($kandidaat->werkervaring < $minWerkervaring || $kandidaat->werkervaring > $maxWerkervaring) {  // Check if the kandidaat's werkervaring is less than the minimum werkervaring or greater than the maximum werkervaring
                    continue;
                }
            }
        }
        $filteredKandidaten[] = $kandidaat; // Add the kandidaat to the filteredKandidaten array
    }
    return $filteredKandidaten;
    }
}
