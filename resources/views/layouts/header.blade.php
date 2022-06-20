<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" type="image/x-icon" href="{{ url('images/logo.png') }}"  />

    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('css/nav.css') }}">
    <script src="{{ url('js/nav.js') }}" defer="true"></script>

    <title>Laravel | @yield('titolo')</title>
</head>
<body>
    <header>

    <nav>
        <div class="l_nav">
            <a href="{{url('home')}}">Home</a>
            <a href="{{url('create')}}">Nuovo post</a>
            <a href="{{url('favorite')}}">Preferiti</a><br><br>
        </div>
        <div class="middle_logo">
            <img src="images/logo.png">
        </div>
        <div class="r_nav">
            <a href="{{url('news')}}">News</a>
            <a id="infoButton">About</a>
            <a href="{{url('logout')}}">Logout</a>
        </div>
    </nav>
    <section id="infoView" class="hidden">
        <div>
            <p id="closeInfo">X</p>
            <p id="infoTitle">Info utili</p>
            <p><strong>Autore:</strong> Giovanni Maria Contarino</p>
            <p><strong>Matricola:</strong> 1000007029</p>
            <p><strong>Anno Accademico:</strong> 2021/2022</p>
            <p><strong>Università:</strong> Università degli Studi di Catania</p>

        </div>
    </section>
    </header>

    @yield('contenuto')
</body>
</html>