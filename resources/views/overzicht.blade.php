<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/stylesheet.css') }}">
    <title>Technius Applicatie</title>
    @include('Header') 
</head>
<body>
    <div class="Filter">
        <button id="FilterButton" onclick="toggleFilters()">Filteren op</button>
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

                <label for="Beschikbaarheid">Beschikbaar</label>
                <select name="beschikbaarheid" id="beschikbaarheid" placeholder="Kies een optie">
                    <option value="">Kies een optie</option>
                    <option value="1">Ja</option>
                    <option value="0">Nee</option>
                </select>
                
                <button type="reset">Reset</button>
                <button type="submit">Filteren</button>
            </form>
        </div>
    </div>
<div class="candidates">
    @foreach ($kandidaten as $kandidaat)
        @php
            $class = '';
            if ($kandidaat->functie == 'Loodgieter') {
                $class = 'Loodgieter';
            } elseif ($kandidaat->functie == 'Elektromonteur') {
                $class = 'Elektromonteur';
            }
        @endphp
        <div class="candidate {{ $class }}">
            <h2>{{ $kandidaat->voornaam }} {{ substr($kandidaat->achternaam, 0, 1) }}</h2>

            <!-- Omzetten van datum naar Nederlandse notatie -->
            <p>Geboortedatum: {{ date('d-m-Y', strtotime($kandidaat->geboortedatum)) }}</p>
            <p>Functie: {{ $kandidaat->functie }}</p>
            <p>Werkervaring: {{ $kandidaat->werkervaring }} jaar</p>
            <a href="{{ url('details/' . $kandidaat->id) }}" class="details">Meer informatie</a>
        </div>
    @endforeach
</div>
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
