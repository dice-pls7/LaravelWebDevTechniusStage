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
    <form action="{{ url('/kandidaat/toevoegen') }}" method="post">
    @csrf
        <div class="form-grid">
            <div class="form-group">
                <label for="Voornaam">Voornaam *</label>
                <input type="text" id="Voornaam" name="Voornaam" required>
            </div>
            <div class="form-group">
                <label for="Tussenvoegsel">Tussenvoegsel</label>
                <input type="text" id="Tussenvoegsel" name="Tussenvoegsel">
            </div>
            <div class="form-group">
                <label for="Achternaam">Achternaam *</label>
                <input type="text" id="Achternaam" name="Achternaam" required>
            </div>
            <div class="form-group">
                <label for="Geboortedatum">Geboortedatum *</label>
                <input type="date" id="Geboortedatum" name="Geboortedatum" required>
            </div>
            <div class="form-group">
                <label for="Beschikbaarheid">Beschikbaar vanaf: *</label>
                <input type="date" id="Beschikbaarheid" name="Beschikbaarheid" required>
            </div>
            <div class="form-group">
                <label for="Functie">Functie *</label>
                <select id="Functie" name="Functie" required>
                    <option value="">Kies een functie</option>
                    <option value="Loodgieter">Loodgieter</option>
                    <option value="Elektromonteur">Elektromonteur</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Beschikbaar">Beschikbaar *</label>
                <select id="Beschikbaar" name="Beschikbaar" required>
                    <option value="">Kies een optie</option>
                    <option value="1">Ja</option>
                    <option value="0">Nee</option>
                </select>
            </div>
            <div class="form-group">
                <label for="Locatie">Locatie *</label>
                <input type="text" id="Locatie" name="Locatie" required>
            </div>
            <div class="form-group">
                <label for="Taal">Taal *</label>
                <input type="text" id="Taal" name="Taal" required>
            </div>
            <div class="form-group">
                <label for="Werkervaring">Werkervaring *</label>
                <input type="text" id="Werkervaring" name="Werkervaring" required>
            </div>
            <div class="form-group">
                <label for="OudeOpdrachtgevers">Oude Opdrachtgevers</label>
                <input type="text" id="OudeOpdrachtgevers" name="OudeOpdrachtgevers">
            </div>
            <div class="form-group">
                <label for="Diplomas">Diploma's</label>
                <input type="text" id="Diplomas" name="Diplomas">
            </div>
            <div class="form-group">
                <label for="Certificaten">Certificaten</label>
                <input type="text" id="Certificaten" name="Certificaten">
            </div>
        </div>
        <label for="FlavourText">Beschrijving kandidaat</label>
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
