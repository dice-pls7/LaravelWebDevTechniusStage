<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kandidaat;
use App\Models\Reviews;
use App\Repositories\KandidaatRepository;
use App\Helpers\EmailHelper;

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
        // Controleer of de kandidaat bestaat voordat je de details ophaalt
        $kandidaat = $this->kandidaatRepository->getKandidaat($id);
        
        if (!auth()->check()) {
            if (!$kandidaat || !$kandidaat->Beschikbaar) {
                // Als de kandidaat niet bestaat of niet beschikbaar is, redirect naar overzicht met foutmelding
                return redirect()->route('overzicht')->with('error', 'Deze kandidaat bestaat niet meer of is niet beschikbaar.');
            }   
        }
        // Haal de reviews op voor de kandidaat
        $reviews = $this->kandidaatRepository->getReviews($id);

        // Genereer e-mail lichaam
        $emailBodyAuth = EmailHelper::generateEmailBody($kandidaat, $reviews);
        $emailBodyInterest = EmailHelper::generateInterestEmailBody($kandidaat);

        // Geef de details view weer
        return view('details', [
            'kandidaat' => $kandidaat,
            'reviews' => $reviews,
            'emailBodyAuth' => $emailBodyAuth,
            'emailBodyInterest' => $emailBodyInterest
        ]);
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
