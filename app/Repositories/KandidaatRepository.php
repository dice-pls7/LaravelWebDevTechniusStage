<?php
namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class KandidaatRepository
{
    public function getAllOrderedByPinned()
    {
        if (auth()->check()) {
            return DB::table('kandidaat')->orderByDesc('pinned')->paginate(12);
        }
        else{
            return DB::table('kandidaat')->orderByDesc('pinned')->where('beschikbaar', 1)->paginate(12);
        }
    }
    public function getKandidaat($id)
    {
        return DB::table('kandidaat')->where('id', $id)->first();
    }
    public function getKandidaatGegevens($id)
    {
        return DB::table('kandidaat')->where('id', $id)->first();
    }
    public function getReviews($kandidaatId)
    {
        return DB::table('reviews')->where('kandidaatId', $kandidaatId)->get();
    }
    public function deleteKandidaat($id)
    {
        return DB::table('kandidaat')->where('id', $id)->delete();
    }
    public function deleteReview($id)
    {
        return DB::table('reviews')->where('id', $id)->delete();
    }
    public function pinKandidaat($id)
    {
        $kandidaat = DB::table('kandidaat')->where('id', $id)->first();
        $pinned = $kandidaat->pinned ? 0 : 1;
        return DB::table('kandidaat')->where('id', $id)->update(['pinned' => $pinned]);
    }
    public function wijzigKandidaat($kandidaat){
        return DB::table('kandidaat')->where('id', $kandidaat->Id)->update([
            'Voornaam' => $kandidaat->Voornaam,
            'Tussenvoegsel' => $kandidaat->Tussenvoegsel,
            'Achternaam' => $kandidaat->Achternaam,
            'Geboortedatum' => $kandidaat->Geboortedatum,
            'Functie' => $kandidaat->Functie,
            'Beschikbaarheid' => $kandidaat->Beschikbaarheid,
            'Beschikbaar' => $kandidaat->Beschikbaar,
            'Locatie' => $kandidaat->Locatie,
            'Taal' => $kandidaat->Taal,
            'Werkervaring' => $kandidaat->Werkervaring,
            'OudeOpdrachtgevers' => $kandidaat->OudeOpdrachtgevers,
            'Diplomas' => $kandidaat->Diplomas,
            'Certificaten' => $kandidaat->Certificaten,
            'FlavourText' => $kandidaat->FlavourText,
            'pinned' => $kandidaat->pinned,
        ]);
    }
    public function insertKandidaat($kandidaat)
    {
    return DB::table('kandidaat')->insert([
        'Voornaam' => $kandidaat->Voornaam,
        'Tussenvoegsel' => $kandidaat->Tussenvoegsel,
        'Achternaam' => $kandidaat->Achternaam,
        'Geboortedatum' => $kandidaat->Geboortedatum,
        'Functie' => $kandidaat->Functie,
        'Beschikbaarheid' => $kandidaat->Beschikbaarheid,
        'Beschikbaar' => $kandidaat->Beschikbaar,
        'Locatie' => $kandidaat->Locatie,
        'Taal' => $kandidaat->Taal,
        'Werkervaring' => $kandidaat->Werkervaring,
        'OudeOpdrachtgevers' => $kandidaat->OudeOpdrachtgevers,
        'Diplomas' => $kandidaat->Diplomas,
        'Certificaten' => $kandidaat->Certificaten,
        'FlavourText' => $kandidaat->FlavourText,
        'pinned' => $kandidaat->pinned,
    ]);
    }
    public function insertReview($review)
    {
        return DB::table('reviews')->insert([
        'KandidaatId' => $review->kandidaatId,
        'bedrijfsnaam' => $review->bedrijfsnaam,
        'review' => $review->review,
    ]);
    }
    public function filterKandidaten($functie, $beschikbaar)
    {
        $query = DB::table('kandidaat')->orderByDesc('pinned');
        if (auth()->check()){
        if ($functie) {
            $query->where('Functie', $functie);
        }
        if ($beschikbaar !== null) {
            $query->where('Beschikbaar', $beschikbaar);
        }
    }else{
        if ($functie) {
            $query->where('Functie', $functie)->where('Beschikbaar', 1);
        }
    }     
        return $query->paginate(12);
    }
}