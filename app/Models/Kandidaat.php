<?php
namespace App\Models;

include 'Functie.php';

class Kandidaat {
    public $id;
    public $voornaam;
    public $tussenvoegsel;
    public $achternaam;
    public $geboortedatum;
    public $functie;
    public $beschikbaarheid;
    public $locatie;
    public $taal;
    public $werkervaring;
    public $oudeOpdrachtgevers;
    public $diplomas;
    public $certificaten;
    public $flavourText;

    public function __construct($id, $voornaam, $tussenvoegsel, $achternaam, $geboortedatum, $functie, $beschikbaarheid, $locatie, $taal, $werkervaring, $oudeOpdrachtgevers,
                $diplomas, $certificaten, $flavourText) {
        $this->id = $id;
        $this->voornaam = $voornaam;
        $this->tussenvoegsel = $tussenvoegsel;
        $this->achternaam = $achternaam;
        $this->geboortedatum = $geboortedatum;
        // Valideer de functie tegen de Functie-enum
        if ($functie !== Functie::Loodgieter && $functie !== Functie::Elektromonteur) {
            print "Functie is niet geldig";
        }
        $this->functie = $functie;
        $this->beschikbaarheid = $beschikbaarheid;
        $this->locatie = $locatie;
        $this->taal = $taal;
        $this->werkervaring = $werkervaring;
        $this->oudeOpdrachtgevers = $oudeOpdrachtgevers;
        $this->diplomas = $diplomas;
        $this->certificaten = $certificaten;
        $this->flavourText = $flavourText;
    }
}