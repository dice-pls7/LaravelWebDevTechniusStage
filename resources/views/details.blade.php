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
    </div>
<div class="Gegevenstabel {{$kandidaat->Functie}}"> <!-- Hier wordt de functie van de kandidaat meegegeven als class voor de kleur-->
    <div id="capture" class="Gegevens">
        <div class="DeleteKnop">
            @if(Route::has('login'))
                @auth
                <button title="Delete kandidaat" type="button" id="deleteButton"><i class="fas fa-trash-can"></i></button>
                <button title="Pin kandidaat" type="button" id="PinKnop" onclick="" ><i class="fas fa-thumbtack"></i></button>
                @endauth
            @endif
                <button title="Deel kandidaat" type="button" id="deelKandidaatKnop"><i class="fas fa-share"></i></button>
        </div>
        <h2><span class=label">{{ $kandidaat->Voornaam }} {{ $kandidaat->Tussenvoegsel }} {{ substr($kandidaat->Achternaam, 0, 1) }}</span></h2>
        <p><span class="label">Geboortedatum: </span>{{ $kandidaat->Geboortedatum }}</p>
        <p><span class="label">Functie: </span>{{ $kandidaat->Functie }}</p>
        <p><span class="label">Beschikbaar vanaf: </span>{{ $kandidaat->Beschikbaarheid }}</p>
        <p><span class="label">Locatie: </span>{{ $kandidaat->Locatie }}</p>
        <p><span class="label">Taal: </span>{{ $kandidaat->Taal }}</p>
        <p><span class="label">Werkervaring: </span>{{ $kandidaat->Werkervaring }} jaar</p>
        <p><span class="label">Oude Opdrachtgevers: </span>{{ $kandidaat->OudeOpdrachtgevers }}</p>
        <p><span class="label">Diploma's: </span>{{ $kandidaat->Diplomas }}</p>
        <p><span class="label">Certificaten: </span>{{ $kandidaat->Certificaten }}</p>
        <p><span class="label">Beschrijving kandidaat: </span>{{ $kandidaat->FlavourText }}</p>

        <div class="referentie">
            <h2>Referenties</h2>
            @if(Route::has('login'))
            @auth
            <form action="{{ url('/review/toevoegen') }}" method="post">
                @csrf
                <input type="hidden" name="KandidaatId" value="{{ $kandidaat->Id }}">

                <input type="text" name="bedrijfsnaam" id="Bedrijfsnaam" required placeholder="Bedrijfsnaam">
                <textarea type="text" name="review" id="Review" required placeholder="Review" maxlength="100"></textarea>

                <button type="submit">Voeg referentie toe</button>
            </form>
            @endauth
            @endif
            @foreach ($reviews as $review)
                <p><span class="label">Bedrijfsnaam: </span>{{$review->Bedrijfsnaam}}<br>
                <span class="label"> Review: </span> {{$review->Review}}
                @if(Route::has('login'))
                    @auth
                        <i title="Delete referentie"class="fas fa-trash-alt deleteReferentie" data-review-id="{{ $review->Id }}"></i>
                    @endauth
                @endif
                </p>
            @endforeach
        </div>

        @if(Route::has('login'))
        @auth
            <div class="WijzigKnop">
                <a id="WijzigButton" href="{{ url('kandidaat/' . $kandidaat->Id . '/wijzigen') }}">Wijzigen Kandidaat</a>
                <!-- Button to trigger email -->
                <a href="mailto:?subject=aanrading: {{ $kandidaat->Voornaam }}&body={{ $emailBodyAuth }}" target="_blank">
                    <button id="MailButton">Stuur Email</button>
                </a>
            </div>

        @else
            <div class="WijzigKnop">
                <a href="mailto:Hello@technius.nl?subject=interesse in: {{ $kandidaat->Voornaam }}&body={{ $emailBodyInterest }}" target="_blank">
                    <button id="MailButton">Interesse? Mail ons!</button>
                </a>
            </div>
        @endif
        @endauth
    </div>
</div>
<script>
    // Define the csrfToken variable and pass it to the external JS file
    var csrfToken = '{{ csrf_token() }}';
</script>
@vite('resources/js/details.js')
</body>
<footer>
    @include('footer')
</footer>
</html>
