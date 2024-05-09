<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>DetailPagina</title>
    <link rel="stylesheet" href="{{ asset('css/StylesDetail.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Footer.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    @include('Header') 
</head>
<body>
    <div class="OverzichtsKnop">
    <a href="{{ url('overzicht') }}" class="Terugknop">Terug naar overzicht</a> 
    </div>

<div class="Gegevenstabel {{$kandidaat->functie}}"> <!-- Hier wordt de functie van de kandidaat meegegeven als class voor de kleur-->

    <div class="Gegevens">
        @if(Route::has('login'))
            @auth
                <div class="DeleteKnop">
                    <button type="button" id="deleteButton"><i class="fas fa-trash-can"></i></button>
                </div>
            @endauth
        @endif
            <h2>{{ $kandidaat->voornaam }} {{ $kandidaat->tussenvoegsel }} {{ $kandidaat->achternaam }}</h2>
            <p><span>Geboortedatum: </span>{{ $kandidaat->geboortedatum }}</p>
            <p><span>Functie: </span>{{ $kandidaat->functie }}</p>
            <p><span>Beschikbaar vanaf: </span>{{ $kandidaat->beschikbaarheid }}</p>
            <p><span>Locatie: </span>{{ $kandidaat->locatie }}</p>
            <p><span>Taal: </span>{{ $kandidaat->taal }}</p>
            <p><span>Werkervaring: </span>{{ $kandidaat->werkervaring }}</p>
            <p><span>Oude Opdrachtgevers: </span>{{ $kandidaat->oudeOpdrachtgevers }}</p>
            <p><span>Diploma's: </span>{{ $kandidaat->diplomas }}</p>
            <p><span>Certificaten: </span>{{ $kandidaat->certificaten }}</p>
            <p><span>Beschrijving kandidaat: </span>{{ $kandidaat->flavourText }}</p>

            <h3>Reviews</h3>
            @foreach ($reviews as $review)
                <p><span>Review: </span>{{ $review->review }}</p>
            @endforeach 

            @if(Route::has('login'))
            @auth
                <div class="WijzigKnop">
                    <a id="WijzigButton" href="{{ url('kandidaat/' . $kandidaat->id . '/wijzigen') }}">Wijzigen Kandidaat</a>
                </div>
            <?php
                // Define variables for email content
                $to = "";
                $subject = "aanrading: ". $kandidaat->voornaam;
                $body = "Naam: $kandidaat->voornaam";
                if (!empty($kandidaat->tussenvoegsel)) {
                    $body .= " $kandidaat->tussenvoegsel";
                }
                $body .= " $kandidaat->achternaam\n";
                $body .= "Geboortedatum: $kandidaat->geboortedatum\n";
                $body .= "Functie: $kandidaat->functie\n";
                $body .= "Beschikbaar vanaf: $kandidaat->beschikbaarheid\n";
                $body .= "Locatie: $kandidaat->locatie\n";
                $body .= "Taal: $kandidaat->taal\n";
                
                if (!empty($kandidaat->werkervaring)) {
                    $body .= "Werkervaring: $kandidaat->werkervaring\n";
                }
                if (!empty($kandidaat->oudeOpdrachtgevers)) {
                    $body .= "Oude Opdrachtgevers: $kandidaat->oudeOpdrachtgevers\n";
                }
                if (!empty($kandidaat->diplomas)) {
                    $body .= "Diploma's: $kandidaat->diplomas\n";
                }
                if (!empty($kandidaat->certificaten)) {
                    $body .= "Certificaten: $kandidaat->certificaten\n";
                }
                if (!empty($kandidaat->flavourText)) {
                    $body .= "Beschrijving kandidaat: $kandidaat->flavourText\n";
                }
                // Encode the email body for URL
                $body_encoded = rawurlencode($body);
                ?>

            <!-- Button to trigger email -->
            <a href="mailto:<?php echo $to; ?>?subject=<?php echo $subject; ?>&body=<?php echo $body_encoded; ?>" target="_blank">
                <button id="MailButton">Stuur Email</button>
            </a>
            @endauth
            @endif
        </div>
    </div>
</body>
<footer>
    @include('footer')
</footer>
<script>
    document.getElementById('deleteButton').addEventListener('click', function() {
        var confirmation = confirm('Weet u zeker dat u deze kandidaat wilt verwijderen?');
        if (confirmation) {
            var id = window.location.href.split('/').pop();
            fetch('/kandidaat/' + id + '/delete', {
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                    'Content-Type': 'application/json'
                }
            }).then(response => {
                if (response.ok) {
                    //navigate to the overview page
                    window.location.href = '/overzicht'; 
                } else {
                    // Er is iets misgegaan
                    console.error('Er is een fout opgetreden bij het verwijderen van de kandidaat');
                }
            }).catch(error => {
                console.error('Er is een fout opgetreden bij het verwijderen van de kandidaat:', error);
            });
        }
    });
</script>
</html>