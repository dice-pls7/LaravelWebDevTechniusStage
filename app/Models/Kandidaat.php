<?php
namespace App\Models;
include 'Functie.php';

class Kandidaat {
    public $Id;
    public $Voornaam;
    public $Tussenvoegsel;
    public $Achternaam;
    public $Geboortedatum;
    public $Functie;
    public $Beschikbaarheid;
    public $Beschikbaar;
    public $Locatie;
    public $Taal;
    public $Werkervaring;
    public $OudeOpdrachtgevers;
    public $Diplomas;
    public $Certificaten;
    public $FlavourText;

    public $pinned;

    public function __construct($id, $voornaam, $tussenvoegsel, $achternaam, $geboortedatum, $functie, $beschikbaarheid, $beschikbaar, $locatie, $taal, $werkervaring, $oudeOpdrachtgevers,
                $diplomas, $certificaten, $flavourText, $pinned) {
        $this->Id = $id;
        $this->Voornaam = $voornaam;
        $this->Tussenvoegsel = $tussenvoegsel;
        $this->Achternaam = $achternaam;
        $this->Geboortedatum = $geboortedatum;
        // Valideer de functie tegen de Functie-enum
        if ($functie !== Functie::Loodgieter && $functie !== Functie::Elektromonteur) {
            
        }
        $this->Functie = $functie;
        $this->Beschikbaarheid = $beschikbaarheid;
        $this->Beschikbaar = $beschikbaar;
        $this->Locatie = $locatie;
        $this->Taal = $taal;
        $this->Werkervaring = $werkervaring;
        $this->OudeOpdrachtgevers = $oudeOpdrachtgevers;
        $this->Diplomas = $diplomas;
        $this->Certificaten = $certificaten;
        $this->FlavourText = $flavourText;
        $this->pinned = $pinned;
    }
}