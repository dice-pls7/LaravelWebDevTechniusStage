<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\KandidaatRepository;

class FilterController extends Controller
{
    private $kandidaatRepository;

    public function __construct(KandidaatRepository $kandidaatRepository)
    {
        $this->kandidaatRepository = $kandidaatRepository;
    }

    public function filterResults(Request $request)
    {
        $functie = $request->input('functie');
        $beschikbaar = $request->input('beschikbaar');


        if ($beschikbaar === '0' || $beschikbaar === '1') {
            $beschikbaar = (int) $beschikbaar;
        } else {
            $beschikbaar = null;
        }

        $kandidaten = $this->kandidaatRepository->filterKandidaten($functie, $beschikbaar);

        return view('overzicht', ['kandidaten' => $kandidaten]);
    }
}
