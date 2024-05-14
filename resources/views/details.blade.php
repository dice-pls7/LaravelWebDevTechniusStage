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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/0.4.1/html2canvas.min.js"></script>
    @include('Header') 
</head>
<body>
    <div class="OverzichtsKnop">
        <a href="{{ url('overzicht') }}" class="Terugknop">Terug naar overzicht</a> 
        <button id="copyButton">Deel Kandidaat</button>
    </div>

<div class="Gegevenstabel {{$kandidaat->Functie}}"> <!-- Hier wordt de functie van de kandidaat meegegeven als class voor de kleur-->

    <div id="capture" class="Gegevens">
        @if(Route::has('login'))
            @auth
                <div class="DeleteKnop">
                    <button type="button" id="deleteButton"><i class="fas fa-trash-can"></i></button>
                </div>
            @endauth
        @endif

            <h2>{{ $kandidaat->Voornaam }} {{ $kandidaat->Tussenvoegsel }} {{ $kandidaat->Achternaam }}</h2>
            <p><span>Geboortedatum: </span>{{ $kandidaat->Geboortedatum }}</p>
            <p><span>Functie: </span>{{ $kandidaat->Functie }}</p>
            <p><span>Beschikbaar vanaf: </span>{{ $kandidaat->Beschikbaarheid }}</p>
            <p><span>Locatie: </span>{{ $kandidaat->Locatie }}</p>
            <p><span>Taal: </span>{{ $kandidaat->Taal }}</p>
            <p><span>Werkervaring: </span>{{ $kandidaat->Werkervaring }}</p>
            <p><span>Oude Opdrachtgevers: </span>{{ $kandidaat->OudeOpdrachtgevers }}</p>
            <p><span>Diploma's: </span>{{ $kandidaat->Diplomas }}</p>
            <p><span>Certificaten: </span>{{ $kandidaat->Certificaten }}</p>
            <p><span>Beschrijving kandidaat: </span>{{ $kandidaat->FlavourText }}</p>

            <div class="referentie">
            <h2>Referenties</h2>
            @if(Route::has('login'))
            @auth
            <form action="{{ url('/handle-review') }}" method="post">
                @csrf
                <input type="hidden" name="KandidaatId" value="{{ $kandidaat->Id }}">

                <input type="text" name="bedrijfsnaam" id="Bedrijfsnaam" placeholder="Bedrijfsnaam">
                <textarea type="text" name="review" id="Review" placeholder="Review"></textarea>

                <button type="submit">Voeg referentie toe</button>
            </form>
            @endauth
            @endif
            @foreach ($reviews as $review)
                    <p>Bedrijfsnaam: {{$review->bedrijfsnaam}}<br>
                    Review: {{$review->review}}</p>
            @endforeach 
            </div>

            @if(Route::has('login'))
            @auth
                
            <?php
                // Define variables for email content
                $to = "";
                $subject = "aanrading: ". $kandidaat->Voornaam;
                $body = "Naam: $kandidaat->Voornaam";
                if (!empty($kandidaat->Tussenvoegsel)) {
                    $body .= " $kandidaat->Tussenvoegsel";
                }
                $body .= " $kandidaat->Achternaam\n";
                $body .= "Geboortedatum: $kandidaat->Geboortedatum\n";
                $body .= "Functie: $kandidaat->Functie\n";
                $body .= "Beschikbaar vanaf: $kandidaat->Beschikbaarheid\n";
                $body .= "Locatie: $kandidaat->Locatie\n";
                $body .= "Taal: $kandidaat->Taal\n";
                
                if (!empty($kandidaat->Werkervaring)) {
                    $body .= "Werkervaring: $kandidaat->Werkervaring\n";
                }
                if (!empty($kandidaat->OudeOpdrachtgevers)) {
                    $body .= "Oude Opdrachtgevers: $kandidaat->OudeOpdrachtgevers\n";
                }
                if (!empty($kandidaat->Diplomas)) {
                    $body .= "Diploma's: $kandidaat->Diplomas\n";
                }
                if (!empty($kandidaat->Certificaten)) {
                    $body .= "Certificaten: $kandidaat->Certificaten\n";
                }
                if (!empty($kandidaat->FlavourText)) {
                    $body .= "Beschrijving kandidaat: $kandidaat->FlavourText\n";
                }
                // Encode the email body for URL
                $body_encoded = rawurlencode($body);
                ?>
                
                <div class="WijzigKnop">
                    <a id="WijzigButton" href="{{ url('kandidaat/' . $kandidaat->Id . '/wijzigen') }}">Wijzigen Kandidaat</a>
                    <!-- Button to trigger email -->
                    <a href="mailto:<?php echo $to; ?>?subject=<?php echo $subject; ?>&body=<?php echo $body_encoded; ?>" target="_blank">
                        <button id="MailButton">Stuur Email</button>
                    </a>
                </div>
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
<script>
document.getElementById('copyButton').onclick = function() {    
    navigator.clipboard.writeText(window.location.href) // Kopieer URL naar klembord
    .then(() => {
        alert('Kandidaat gekopieerd naar klembord: ' + window.location.href); // Succesbericht
    })
    .catch(err => {
        console.error('Kopiëren is mislukt, probeer later opnieuw'); // Foutbericht
    });
};
</script>
</html>