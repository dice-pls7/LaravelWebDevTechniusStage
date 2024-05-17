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

                <label for="werkervaring">Werkervaring</label>
                <select name="werkervaring" id="werkervaring">
                    <option value="">Kies een optie</option>
                    <option value="0-1">0-1 jaar</option>
                    <option value="2-4">2-4 jaar</option>
                    <option value="5-7">5-7 jaar</option>
                    <option value="8-10">8-10 jaar</option>
                    <option value="11-13">11-13 jaar</option>
                    <option value="14-16">17-19 jaar</option>
                    <option value="20+">20+ jaar</option>

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

    <h2 class ="Tekstbovenkandidaat">Vastgezette kandidaten</h2>  <!-- aangeven welke kandidaat gepinned is -->
<div class="pinned-candidates">
   
@foreach ($pinnedKandidaten as $pinnedKandidaat) 
            @php
                $class = '';
                if ($pinnedKandidaat->Functie == 'Loodgieter') {
                    $class = 'Loodgieter';
                } elseif ($pinnedKandidaat->Functie == 'Elektromonteur') {
                    $class = 'Elektromonteur';
                }
            @endphp
    

    <div class="candidate {{ $class }}">
            <h2>{{ $pinnedKandidaat->Voornaam }} {{ substr($pinnedKandidaat->Achternaam, 0, 1) }}</h2>
            <p>Geboortedatum: {{ date('d-m-Y', strtotime($pinnedKandidaat->Geboortedatum)) }}</p>
            <p>Functie: {{ $pinnedKandidaat->Functie }}</p>
            <p>Werkervaring: {{ $pinnedKandidaat->Werkervaring }} jaar</p>
            <a href="{{ url('details/' . $pinnedKandidaat->Id) }}" class="details">Meer informatie</a>
        </div>
    @endforeach
</div>
<h2 class ="Tekstbovenkandidaat">Kandidaten</h2> <!-- aangeven welke kandidaat niet gepinned is -->
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

    @if ($kandidaat->pinned)
            <!-- Skip already displayed pinned candidates -->
            @continue
        @endif

        <div class="candidate {{ $class }}">
            <h2>{{ $kandidaat->Voornaam }} {{ substr($kandidaat->Achternaam, 0, 1) }}</h2>

            <!-- Omzetten van datum naar Nederlandse notatie -->
            <p>Geboortedatum: {{ date('d-m-Y', strtotime($kandidaat->Geboortedatum)) }}</p>
            <p>Functie: {{ $kandidaat->Functie }}</p>
            <p>Werkervaring: {{ $kandidaat->Werkervaring }} jaar</p>
            <a href="{{ url('details/' . $kandidaat->Id) }}" class="details">Meer informatie</a>
        </div>
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