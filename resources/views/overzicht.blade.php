<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/stylesheet.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Technius - KandidatenApplicatie</title>
    @include('Header')
    <meta name=”robots” content=”noindex”>
    <meta name="google-site-verification" content="ICooGiP25wM9YyrUt5S55LkQUgA-_AcBCkFmzGZlMuY" />
</head>
<body>
    <div class="Filter">
        <button id="FilterButton">Filteren op</button>
        <button id="WisFilter" onclick="window.location.href='{{ route('overzicht') }}'">Wis filters</button>
        <!-- Filter options -->
        <div class="filters" id="Filters">
            <button id="FilterButton2">X</button>
            <form action="{{ route('overzicht') }}" method="POST">
                @csrf
                <label for="functie">Functie</label>
                <select name="functie" id="functie">
                    <option value="">Kies een optie</option>
                    <option value="Elektromonteur">Elektromonteur</option>
                    <option value="Loodgieter">Loodgieter</option>
                    <option value="Overig">Overig</option>
                </select>
                @if(Route::has('login'))
                    @auth
                <label for="beschikbaar">Beschikbaar</label>
                <select name="beschikbaar" id="beschikbaar">
                    <option value="">Kies een optie</option>
                    <option value="1">Ja</option>
                    <option value="0">Nee</option>
                </select>
                @endauth
                @endif
                <button type="reset">Reset filter opties</button>
                <button type="submit">Filteren</button>
            </form>
        </div>
    </div>

    <div class="candidates">
        @foreach ($kandidaten as $kandidaat)
            @php
                $class = '';
                if ($kandidaat->Functie == 'Loodgieter') {
                    $class = 'Loodgieter';
                } elseif ($kandidaat->Functie == 'Elektromonteur') {
                    $class = 'Elektromonteur';
                }elseif ($kandidaat->Functie == 'Overig') {
                    $class = 'Overig';
                }
            @endphp
            <div class="candidate {{ $class }}">
                <input type="hidden" class="kandidaatId" value="{{ $kandidaat->Id }}">
                @if(Route::has('login'))
                    @auth
                    @if($kandidaat->pinned)
                        <button title="Losmaken" type="button" class="PinKnop" data-id="{{ $kandidaat->Id }}">
                            <i class="fas fa-thumbtack"></i>
                        </button>
                    @endif
                    @endauth
                @endif
                <a href="{{ url('details/' . $kandidaat->Id) }}" class="details">
                    <div class="NaamFunctie">
                    <h3>{{ $kandidaat->Voornaam }} {{ substr($kandidaat->Achternaam, 0, 1) }}</h3>
                    <h3>{{ $kandidaat->Functie }}</h3>
                    </div>
                    <p>Functie titel: {{ $kandidaat->FunctieTitel }}</p>
                    <!-- Omzetten van datum naar Nederlandse notatie -->
                    <p>Geboortedatum: {{ date('d-m-Y', strtotime($kandidaat->Geboortedatum)) }}</p>
                    <p>Werkervaring: {{ $kandidaat->Werkervaring }} jaar</p>
                </a>
            </div>
        @endforeach
    </div>
    @if($kandidaten instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="mt-3">
            {{ $kandidaten->links() }}
        </div>
    @endif
    <footer>
        @include('Footer')
    </footer>
    <script>
                // Define the csrfToken variable and pass it to the external JS file
                var csrfToken = '{{ csrf_token() }}';

    </script>
    @vite('resources/js/overzicht.js')
</body>
</html>
