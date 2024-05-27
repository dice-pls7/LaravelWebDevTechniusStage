<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/stylesheet.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Technius Applicatie</title>
    @include('Header')
</head>
<body>
    <div class="Filter">
        <button id="FilterButton" onclick="toggleFilters()">Filteren op</button>
        <button id="WisFilter" onclick="window.location.href='{{ route('overzicht') }}'">Wis filters</button>
        <!-- Filter options -->
        <div class="filters" id="Filters">
            <form action="{{ route('overzicht') }}" method="POST">
                @csrf
                <button type="reset" onclick="toggleFilters()">X</button>

                <label for="functie">Functie</label>
                <select name="functie" id="functie">
                    <option value="">Kies een optie</option>
                    <option value="Loodgieter">Loodgieter</option>
                    <option value="Elektromonteur">Elektromonteur</option>
                </select>

                <label for="beschikbaar">Beschikbaar</label>
                <select name="beschikbaarheid" id="beschikbaarheid">
                    <option value="">Kies een optie</option>
                    <option value="1">Ja</option>
                    <option value="0">Nee</option>
                </select>

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
                }
            @endphp

        <a class="candidate {{ $class }}" href="{{ url('details/' . $kandidaat->Id) }}" class="details">
        @if(Route::has('login'))
                    @auth
            @if($kandidaat->pinned == 1)
            <button title="Kandidaat is gepind" type="button" id="PinKnop" onclick="" ><i class="fas fa-thumbtack"></i></button>
            @endif
            @endauth
        @endif
            <h2>{{ $kandidaat->Voornaam }} {{ substr($kandidaat->Achternaam, 0, 1) }}</h2>

            <!-- Omzetten van datum naar Nederlandse notatie -->
            <p>Geboortedatum: {{ date('d-m-Y', strtotime($kandidaat->Geboortedatum)) }}</p>
            <p>Functie: {{ $kandidaat->Functie }}</p>
            <p>Werkervaring: {{ $kandidaat->Werkervaring }} jaar</p>
        </a>
    @endforeach
</div>
    @if($kandidaten instanceof \Illuminate\Pagination\AbstractPaginator)
        <div class="mt-3">
            {{ $kandidaten->links() }}
        </div>
    @endif
</body>
<script>
    function toggleFilters() {
        var filters = document.getElementById("Filters");
        filters.style.display = (filters.style.display === "block") ? "none" : "block";
    }
</script>
<footer>
    @include('footer')
</footer>
</html>
