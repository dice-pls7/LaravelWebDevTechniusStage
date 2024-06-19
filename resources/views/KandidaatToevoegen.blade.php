<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('/css/Toevoegen.css') }}">
    <title>Kandidaat Toevoegen</title>
    @include('Header')
    <meta name=”robots” content=”noindex”>
</head>
<body>

<div class="Toevoegen">
    <form action="{{ url('/kandidaat/toevoegen') }}" method="post">
    @csrf
        <div class="form-grid">
            <div class="form-group">
                <label for="Voornaam">Voornaam *</label>
                <input type="text" id="Voornaam" name="Voornaam" maxlength = "15" required>
            </div>
            <div class="form-group">
                <label for="Tussenvoegsel">Tussenvoegsel</label>
                <input type="text" id="Tussenvoegsel" name="Tussenvoegsel" maxlength = "15">
            </div>
            <div class="form-group">
                <label for="Achternaam">Achternaam *</label>
                <input type="text" id="Achternaam" name="Achternaam" maxlength = "15" required>
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
                    <option value="Overig">Overig</option>
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
                <label for="FunctieTitel">Functie titel *</label>
                <input type="text" id="FunctieTitel" name="FunctieTitel" maxlength = "25" required>
            </div>
            <div class="form-group">
                <label for="Locatie">Locatie *</label>
                <input type="text" id="Locatie" name="Locatie" maxlength = "15" required>
            </div>
            <div class="form-group">
                <label for="Taal">Taal *</label>
                <input type="text" id="Taal" name="Taal" maxlength = "15" required>
            </div>
            <div class="form-group">
                <label for="Werkervaring">Werkervaring in jaren *</label>
                <input type="text" id="Werkervaring" name="Werkervaring" pattern="\d+" minlength="1" maxlength="2" required>
            </div>
            <div class="form-group">
                <label for="OudeOpdrachtgevers">Oude Opdrachtgevers</label>
                <input type="text" id="OudeOpdrachtgevers" name="OudeOpdrachtgevers" maxlength = "100">
            </div>
            <div class="form-group">
                <label for="Diplomas">Diploma's</label>
                <input type="text" id="Diplomas" name="Diplomas" maxlength = "100">
            </div>
            <div class="form-group">
                <label for="Certificaten">Certificaten</label>
                <input type="text" id="Certificaten" name="Certificaten" maxlength = "100">
            </div>
        </div>
        <label for="FlavourText">Beschrijving kandidaat</label>
        <textarea id="FlavourText" name="FlavourText" maxlength = "700"></textarea>

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
