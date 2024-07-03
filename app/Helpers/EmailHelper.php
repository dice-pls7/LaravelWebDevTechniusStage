<?php

namespace App\Helpers;

class EmailHelper
{
    public static function generateEmailBody($kandidaat, $reviews)
    {
        $body = "$kandidaat->Voornaam";
        if (!empty($kandidaat->Tussenvoegsel)) {
            $body .= " $kandidaat->Tussenvoegsel";
        }
        $body .= " " . $kandidaat->Achternaam . "\n";
        $body .= "Geboortedatum:                       " . date('d-m-Y', strtotime($kandidaat->Geboortedatum)) . "\n";
        $body .= "Functie:                                       $kandidaat->Functie\n";
        $body .= "Beschikbaar vanaf:                    " . date('d-m-Y', strtotime($kandidaat->Beschikbaarheid)) . "\n";
        $body .= "Locatie:                                        $kandidaat->Locatie\n";
        $body .= "Taal:                                             $kandidaat->Taal\n";

        if (!empty($kandidaat->Werkervaring)) {
            $body .= "Werkervaring:                            $kandidaat->Werkervaring jaar\n";
        }
        if (!empty($kandidaat->OudeOpdrachtgevers)) {
            $body .= "Oude Opdrachtgevers:             $kandidaat->OudeOpdrachtgevers\n";
        }
        if (!empty($kandidaat->Diplomas)) {
            $body .= "Diploma's:                                   $kandidaat->Diplomas\n";
        }
        if (!empty($kandidaat->Certificaten)) {
            $body .= "Certificaten:                                $kandidaat->Certificaten\n";
        }
        if (!empty($kandidaat->FlavourText)) {
            $body .= "Beschrijving kandidaat:             $kandidaat->FlavourText\n";
        }
        if (!empty($reviews[0])) {
            $body .= "\nReferenties:";
            foreach ($reviews as $review) {
                $body .= "                              Bedrijfsnaam: $review->Bedrijfsnaam\n";
                $body .= "                                                    Review: $review->Review\n";
            }
        }

        return rawurlencode($body);
    }
    
    public static function generateInterestEmailBody($kandidaat)
    {
        $body = "Beste Team Technius, \n\n Ik heb interesse in de volgende kandidaat: \n\n";
        $body .= "Naam: $kandidaat->Voornaam";
        if (!empty($kandidaat->Tussenvoegsel)) {
            $body .= " $kandidaat->Tussenvoegsel";
        }
        $body .=  " " . substr($kandidaat->Achternaam, 0, 1). "\n";
        $body .= "Geboortedatum: " . date('d-m-Y', strtotime($kandidaat->Geboortedatum)) . "\n";
        $body .= "Functie: $kandidaat->Functie\n";
        
        $body .= "\n Met vriendelijke groet, \n\n Uw naam: \n Uw telefoonnummer: \n Uw emailadres: \n\n";

        return rawurlencode($body);
    }
}
