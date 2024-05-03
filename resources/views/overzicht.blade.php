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
<footer>
    @include('footer')
</footer>
</html>
