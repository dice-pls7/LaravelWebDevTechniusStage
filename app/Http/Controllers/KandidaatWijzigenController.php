<?php

namespace App\Http\Controllers;

use App\Models\Kandidaat;
use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Repositories\KandidaatRepository;

class KandidaatWijzigenController extends Controller
{
    private $kandidaatRepository;

    public function __construct(KandidaatRepository $kandidaatRepository)
    {
        $this->kandidaatRepository = $kandidaatRepository;
    }
    public function wijzigen(Request $request)
    {
        $kandidaat = new Kandidaat(
            $request->input("id"),
            $request->input("Voornaam"),
            $request->input("Tussenvoegsel"),
            $request->input("Achternaam"),
            $request->input("Geboortedatum"),
            $request->input("Functie"),
            $request->input("FunctieTitel"),
            $request->input("Beschikbaarheid"),
            $request->input("Beschikbaar"),
            $request->input("Locatie"),
            $request->input("Taal"),
            $request->input("Werkervaring"),
            $request->input("OudeOpdrachtgevers"),
            $request->input("Diplomas"),
            $request->input("Certificaten"),
            $request->input("FlavourText"),
            $request->input("Pinned"),
        );
        $this->kandidaatRepository->wijzigKandidaat($kandidaat);
        
        return redirect()->route('details', ['id' => $kandidaat->Id]);
    }
}