<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Toevoegen.css') }}">
    <title>Toevoegen Kandidaat</title>
    @include('Header')
</head>
<body>
<div class="Toevoegen">
    <form action="{{ url('/handle-form') }}" method="post">
    @csrf
        <label for="Voornaam">Voornaam *</label>
        <input type="text" id="Voornaam" name="Voornaam" required>

        <label for="Tussenvoegsel">Tussenvoegsel</label>
        <input type="text" id="Tussenvoegsel" name="Tussenvoegsel">

        <label for="Achternaam">Achternaam *</label>
        <input type="text" id="Achternaam" name="Achternaam" required>

        <label for="Geboortedatum">Geboortedatum *</label>
        <input type="date" id="Geboortedatum" name="Geboortedatum" required>

        <?php
        use App\Models\Functie;
        $optie1 = Functie::Loodgieter;
        $optie2 = Functie::Elektromonteur;
        ?>

        <label for="Functie">Functie *</label>
        <select id="Functie" name="Functie" required>
            <option value="">Kies een functie</option>
            <option value="<?php echo $optie1; ?>">Loodgieter</option>
            <option value="<?php echo $optie2; ?>">Elektromonteur</option>
        </select>

        <label for="Beschikbaarheid">Beschikbaarheid *</label>
        <input type="date" id="Beschikbaarheid" name="Beschikbaarheid"  required>

        <label for="Locatie">Locatie *</label>
        <input type="text" id="Locatie" name="Locatie"required>

        <label for="Taal">Taal *</label>
        <input type="text" id="Taal" name="Taal" required>

        <label for="Werkervaring">Werkervaring *</label>
        <input type="text" id="Werkervaring" name="Werkervaring" required>

        <label for="OudeOpdrachtgevers">Oude Opdrachtgevers</label>
        <input type="text" id="OudeOpdrachtgevers" name="OudeOpdrachtgevers">

        <label for="Diplomas">Diploma's</label>
        <input type="text" id="Diplomas" name="Diplomas">

        <label for="Certificaten">Certificaten</label>
        <input type="text" id="Certificaten" name="Certificaten">

        <label for="FlavourText">Flavour Text</label>
        <textarea id="FlavourText" name="FlavourText"></textarea>

        <div class="Buttons">
            <a href="{{ url('overzicht') }}">Terug naar overzicht</a>
            <button type="submit">Toevoegen</button>
        </div>
    </form>
</div>
</body>
<footer>
@include('footer')
</footer>
</html>


