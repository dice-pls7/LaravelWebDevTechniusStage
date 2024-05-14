<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('/css/Toevoegen.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Header.css') }}">
    <link rel="stylesheet" href="{{ asset('/css/Footer.css') }}">
    <title>Toevoegen Kandidaat</title>
    @include('Header')
</head>
<body>
<div class="Toevoegen">
    <form action="{{ url('/handle_WijzigKandidaatForm') }}" method="post">
        @csrf
         <input type="hidden" name="id" value= "<?php print($kandidaat->id)?>">

        <label for="Voornaam">Voornaam *</label>
        <input type="text" id="Voornaam" name="Voornaam" value="<?php print($kandidaat->voornaam)?>" required>

        <label for="Tussenvoegsel">Tussenvoegsel</label>
        <input type="text" id="Tussenvoegsel" name="Tussenvoegsel" value="<?php print($kandidaat->tussenvoegsel)?>">

        <label for="Achternaam">Achternaam *</label>
        <input type="text" id="Achternaam" name="Achternaam" value="<?php print($kandidaat->achternaam)?>"required>

        <label for="Geboortedatum">Geboortedatum *</label>
        <input type="date" id="Geboortedatum" name="Geboortedatum" value="<?php print($kandidaat->geboortedatum)?>" required>

        <label for="Functie">Functie *</label>
        <select id="Functie" name="Functie"  required>
            <option value="Loodgieter" <?php if($kandidaat->functie == "Loodgieter") print("selected")?>>Loodgieter</option>
            <option value="Elektromonteur" <?php if($kandidaat->functie == "Elektromonteur") print("selected")?>>Elektromonteur</option>
        </select>

        <label for="Beschikbaarheid">Beschikbaar vanaf: *</label>
        <input type="date" id="Beschikbaarheid" name="Beschikbaarheid" value="<?php print($kandidaat->beschikbaarheid)?>" required>

        <label for="Beschikbaar">Beschikbaar *</label>
        <select id="Beschikbaar" name="Beschikbaar" required>
            <option value="1" <?php if($kandidaat->beschikbaar == 1) print("selected")?>>Ja</option>
            <option value="0" <?php if($kandidaat->beschikbaar == 0) print("selected")?>>Nee</option>
        </select>

        <label for="Locatie">Locatie *</label>
        <input type="text" id="Locatie" name="Locatie" value="<?php print($kandidaat->locatie)?>"required>

        <label for="Taal">Taal *</label>
        <input type="text" id="Taal" name="Taal" value="<?php print($kandidaat->taal)?>" required>

        <label for="Werkervaring">Werkervaring *</label>
        <input type="text" id="Werkervaring" name="Werkervaring" value="<?php print($kandidaat->werkervaring)?>" required>

        <label for="OudeOpdrachtgevers">Oude Opdrachtgevers</label>
        <input type="text" id="OudeOpdrachtgevers" name="OudeOpdrachtgevers" value="<?php print($kandidaat->oudeOpdrachtgevers)?>">

        <label for="Diplomas">Diploma's</label>
        <input type="text" id="Diplomas" name="Diplomas" value="<?php print($kandidaat->diplomas)?>">

        <label for="Certificaten">Certificaten</label>
        <input type="text" id="Certificaten" name="Certificaten" value="<?php print($kandidaat->certificaten)?>">

        <label for="FlavourText">Beschrijving kandidaat</label>
        <textarea id="FlavourText" name="FlavourText" ><?php print($kandidaat->flavourText)?></textarea>

        

        <div class="Buttons">
            <a href="{{ url('/overzicht') }}">Annuleren</a>
            <button type="submit">Wijzingen opslaan</button>
        </div>

    </form>
</div>
</body>
<footer>
    @include('footer')
</footer>
</html>


