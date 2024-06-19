<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidaat;
use App\Repositories\KandidaatRepository;

class KandidaatToevoegenController extends Controller
{
    private $kandidaatRepository;

    public function __construct(KandidaatRepository $kandidaatRepository)
    {
        $this->kandidaatRepository = $kandidaatRepository;
    }
    public function toevoegen(Request $request)
    {
        // Haal gegevens op uit het formulier
        $kandidaat = new Kandidaat(
            null,   // Id wordt automatisch gegenereerd
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
            0, // Pinned is standaard 0
        );

        // Voeg de kandidaat toe aan de database
        $this->kandidaatRepository->insertKandidaat($kandidaat);

        return redirect()->route('overzicht');
    }
}
