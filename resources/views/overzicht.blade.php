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
                        <option value="Loodgieter">Loodgieter</option>
                        <option value="Elektromonteur">Elektromonteur</option>
                    </select>

                    <label for="beschikbaar">Beschikbaar</label>
                    <select name="beschikbaar" id="beschikbaar">
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
                <div class="candidate {{ $class }}">
                <input type="hidden" id="kandidaatId" value="{{ $kandidaat->Id }}">
                    @if(Route::has('login'))
                        @auth
                            @if($kandidaat->pinned == 1)
                                <button title="Kandidaat is gepind" type="button" id="PinKnop" onclick=""><i class="fas fa-thumbtack"></i></button>
                            @endif
                        @endauth
                    @endif
                    <a href="{{ url('details/' . $kandidaat->Id) }}" class="details">
                        <h2>{{ $kandidaat->Voornaam }} {{ substr($kandidaat->Achternaam, 0, 1) }}</h2>
                        <!-- Omzetten van datum naar Nederlandse notatie -->
                        <p>Geboortedatum: {{ date('d-m-Y', strtotime($kandidaat->Geboortedatum)) }}</p>
                        <p>Functie: {{ $kandidaat->Functie }}</p>
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
    </div>
    <footer>
        @include('Footer')
    </footer>
    <script>
                   document.getElementById('PinKnop').addEventListener('click', function() {
                       var id = document.getElementById('kandidaatId').value;
                       fetch('/kandidaat/' + id + '/pin', {
                           method: 'POST',
                           headers: {
                               'X-CSRF-TOKEN': '{{ csrf_token() }}',
                               'Content-Type': 'application/json'
                            }
                       }).then(response => {
                           if (response.ok) { window.location.href = '/overzicht';}
                           else { console.error('Er is een fout opgetreden bij het pinnen van de kandidaat');
                           }
                       }).catch(error => { console.error('Er is een fout opgetreden bij het pinnen van de kandidaat:', error);
                       });
                   });
                  </script>
    @vite('resources/js/overzicht.js')
</body>
</html>
