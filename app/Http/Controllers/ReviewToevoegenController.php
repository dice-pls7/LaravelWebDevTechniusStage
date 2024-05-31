<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Reviews;
use App\Repositories\KandidaatRepository;

class ReviewToevoegenController extends Controller
{
    private $kandidaatRepository;

    public function __construct(KandidaatRepository $kandidaatRepository)
    {
        $this->kandidaatRepository = $kandidaatRepository;
    }
    public function toevoegen(Request $request)
    {
        // Haal gegevens op uit het formulier
        $review = new Reviews(
            null,   // Id wordt automatisch gegenereerd
            $request->input("KandidaatId"),
            $request->input("bedrijfsnaam"),
            $request->input("review"),
        );

        // Voeg de kandidaat toe aan de database
        $this->kandidaatRepository->insertReview($review);

        return redirect()->back();
    }
}
