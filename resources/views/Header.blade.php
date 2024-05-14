<header class="header">
    <link rel="stylesheet" href="{{ asset('css/Header.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    @if (Route::has('login'))
        @auth
            <a href="{{ url('/kandidaattoevoegen') }}" id="ToevoegenKandidaat">Kandidaat Toevoegen</a>
            <a href="" id="Contact">Neem contact op</a>
            <div class="dropdown">
                <button class="dropbtn">{{ Auth::user()->name }}</button>
                <div class="dropdown-content">
                    <a href="{{ route('profile.edit') }}" id="Profile">Profiel</a>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" id="Logout">Log uit</button>
                    </form>
                </div>
            </div>
        @else
            <a href="" id="Contact">Neem contact op</a>
        @endauth
    @endif
</header>