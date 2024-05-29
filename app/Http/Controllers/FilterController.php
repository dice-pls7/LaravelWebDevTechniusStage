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
        $beschikbaarheid = $request->input('beschikbaarheid');

        $kandidaten = $this->kandidaatRepository->filterKandidaten($functie, $beschikbaarheid);

        return view('overzicht', ['kandidaten' => $kandidaten]);
    }
}
