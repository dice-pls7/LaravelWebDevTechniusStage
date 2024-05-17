<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Header.css') }}">
    <title>Technius Applicatie</title>
</head>
<body>
    <nav>
        <ul class="sidebar">
        <li><a onclick="hideMobileMenu()"><svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#e8eaed"><path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/></svg></a></li>
                @if(Route::has('login'))
                @auth 
                <li><a href="{{ url('/kandidaattoevoegen') }}" >Kandidaat Toevoegen</a></li>
                @endauth
                @endif
            <li><a href="#footer">Neem contact op</a></li>
                @if(Route::has('login'))
                @auth
                <li><a href="{{ route('profile.edit') }}">Profiel</a></li>
                <li>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log uit</a>
                    </form>
                </li>
                @endauth
                @endif
        </ul>
        <ul>
                @if(Route::has('login'))
                @auth
                <li class="hideOnMobile"><a href="{{ url('/kandidaattoevoegen') }}" id="toevoegenKandidaat">Kandidaat Toevoegen</a></li>
                @endauth
                @endif
            <li class="hideOnMobile"><a href="#footer" id="Contact">Neem contact op</a></li>
                @if(Route::has('login'))
                @auth
                <li class="hideOnMobile"><a href="{{ route('profile.edit') }}" id="Profile">Profiel</a></li>
                <li class="hideOnMobile"> 
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" id="Logout">Log uit</button>
                    </form>
                </li>
                @endauth
                @endif
            <li class="menu-button" onclick="toggleMobileMenu()"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#e8eaed"><path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/></svg></a></li>
        </ul>
    </nav>
    <script>
        function toggleMobileMenu() {
            const sidebar = document.querySelector(".sidebar");
           sidebar.style.display = 'flex'
        }
        function hideMobileMenu() {
            const sidebar = document.querySelector(".sidebar");
            sidebar.style.display = 'none'
        }
    </script>
</body>
</html>