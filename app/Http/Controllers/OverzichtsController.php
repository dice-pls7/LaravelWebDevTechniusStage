<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidaat;
use App\Models\Reviews;
use App\Repositories\KandidaatRepository;
class OverzichtsController extends Controller
{
    private $kandidaatRepository;
    public function __construct(KandidaatRepository $kandidaatRepository)
    {
        $this->kandidaatRepository = $kandidaatRepository;
    }

    public function overzicht()
    {
        $kandidaten = $this->kandidaatRepository->getAllOrderedByPinned();
        return view('overzicht', ['kandidaten' => $kandidaten]);
    }

    public function details($id)
    {
        $kandidaat = $this->kandidaatRepository->getKandidaat($id);
        $reviews = $this->kandidaatRepository->getReviews($id);
        return view('details', ['kandidaat' => $kandidaat, 'reviews' => $reviews]);
    }

    public function delete($id)
    {
        $this->kandidaatRepository->deleteKandidaat($id);
        return redirect()->route('overzicht');
    }

    public function deleteReview($id)
    {
        $this->kandidaatRepository->deleteReview($id);
        return redirect()->route('overzicht');
    }

    public function wijzigen($id)
    {
        $kandidaat = $this->kandidaatRepository->getKandidaatGegevens($id);
        return view('wijzigen', ['kandidaat' => $kandidaat]);
    }

    public function pin($id)
    {
        $this->kandidaatRepository->pinKandidaat($id);
        return redirect()->route('overzicht');
    }
}
