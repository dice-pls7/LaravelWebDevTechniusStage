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
    return view('overzicht', ['kandidaten' => $kandidaten]);
    }   
    public function getFilteredKandidaten(Request $request)
    {
    $kandidaten = $this->controller->getAllKandidaten();

    $filteredKandidaten = [];

    foreach ($kandidaten as $kandidaat) {
        if ($request->filled('functie') && $kandidaat->functie != $request->input('functie')) {
            continue;
        }
        if ($request->filled('beschikbaarheid') && $kandidaat->beschikbaar != $request->input('beschikbaarheid')) {
            continue;
        }
        if ($request->input('werkervaring')) {
            $werkervaring = $request->input('werkervaring');
            if ($werkervaring === '20+') {
                if ($kandidaat->werkervaring <= 20) {
                    continue;
                }
            } else {
                $werkervaringRange = explode('-', $werkervaring);
                $minWerkervaring = intval($werkervaringRange[0]);
                $maxWerkervaring = intval($werkervaringRange[1]);
                
                if ($kandidaat->werkervaring < $minWerkervaring || $kandidaat->werkervaring > $maxWerkervaring) {
                    continue;
                }
            }
        }
        $filteredKandidaten[] = $kandidaat;
    }   
    return $filteredKandidaten;
    }
}