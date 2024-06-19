<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/Header.css') }}">
    <meta name=”robots” content=”noindex”>
</head>
<body>
    <?php
        // Define variables for email content
        $to = "hello@technius.nl";
        $subject = "Aanvraag";
        $body = "Beste Team Technius," . "\n\n";
        $body .= "Graag zou ik een aanvraag willen indienen voor het volgende:" . "\n\n";
        $body .= "Project:" . "\n";
        $body .= "Startdatum:" . "\n";
        $body .= "Type monteur:" . "\n";
        $body .= "\n";
        $body .= "Ik ben te bereiken op: 06-";
        $body .= "\n\n";
        $body .= "Met vriendelijke groet," . "\n\n";
        $body .= "[Uw Naam]";

        // Encode the email body for URL
        $body_encoded = rawurlencode($body);
    ?>
    <nav>
        <div class="logo">
            <a href="{{ url('/overzicht') }}"></a>
        </div>
        <ul class="menu-items">
            @if(Route::has('login'))
                @auth
                    <li class="hideOnMobile"><a href="mailto:{{ $to }}?subject={{ $subject }}&body={{ $body_encoded }}" target="_blank" id="Aanvraag">Aanvraag doen</a></li>
                    <li class="hideOnMobile"><a href="{{ url('/kandidaattoevoegen') }}" id="toevoegenKandidaat">Kandidaat Toevoegen</a></li>
                    <li class="hideOnMobile"><a href="{{ route('profile.edit') }}" id="Profile">Profiel</a></li>
                    <li class="hideOnMobile">
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" id="Logout">Log uit</button>
                        </form>
                    </li>
                @else
                    <li class="hideOnMobile"><a href="mailto:<?php echo $to; ?>?subject=<?php echo $subject; ?>&body=<?php echo $body_encoded; ?>" target="_blank" id="Aanvraag">Aanvraag doen</a></li>
                    <li class="hideOnMobile"><a href="#footer" id="Contact">Neem contact op</a></li>
                    <li class="hideOnMobile"><a href="{{ route('login') }}" id="Login">Inloggen</a></li>
                    
                @endauth
            @endif
            <li class="menu-button" onclick="toggleMobileMenu()">
                <a href="#">
                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#e8eaed">
                        <path d="M120-240v-80h720v80H120Zm0-200v-80h720v80H120Zm0-200v-80h720v80H120Z"/>
                    </svg>
                </a>
            </li>
        </ul>
        <ul class="sidebar">
            <li>
                <a onclick="hideMobileMenu()">
                    <svg xmlns="http://www.w3.org/2000/svg" height="30px" viewBox="0 -960 960 960" width="30px" fill="#e8eaed">
                        <path d="m256-200-56-56 224-224-224-224 56-56 224 224 224-224 56 56-224 224 224 224-56 56-224-224-224 224Z"/>
                    </svg>
                </a>
            </li>
            @if(Route::has('login'))
                @auth
                    <li><a href="mailto:{{ $to }}?subject={{ $subject }}&body={{ $body_encoded }}" target="_blank">Aanvraag doen</a></li>
                    <li><a href="{{ url('/kandidaattoevoegen') }}">Kandidaat Toevoegen</a></li>
                    <li><a href="{{ route('profile.edit') }}">Profiel</a></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); this.closest('form').submit();">Log uit</a>
                        </form>
                    </li>
                @else
                    <li><a href="{{ route('login') }}">Inloggen</a></li>
                    <li><a href="mailto:{{ $to }}?subject={{ $subject }}&body={{ $body_encoded }}" target="_blank">Aanvraag doen</a></li>
                    <li><a href="#footer">Neem contact op</a></li>
                @endauth
            @endif
            
        </ul>
    </nav>
    <script>
        function toggleMobileMenu() {
            const sidebar = document.querySelector(".sidebar");
            sidebar.style.display = sidebar.style.display === 'flex' ? 'none' : 'flex';
        }

        function hideMobileMenu() {
            const sidebar = document.querySelector(".sidebar");
            sidebar.style.display = 'none';
        }
    </script>
</body>
</html>
