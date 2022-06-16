<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> GTech Tips</title>
    <link rel="shortcut icon" type="image/x-icon" href='{{ url('images/logo.png') }}' />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href='{{ url('css/news.css') }}'>
    <script>
        const BASE_URL = "{{ url('/') }}/";
    </script>
    <script src='{{ url('js/news.js') }}' defer="true"></script>
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

    <p id="posts_title"> Qui puoi trovare le ultime news/recensioni da parte del nostro staff!<br>
    </p>
    <section id="news">
    </section>

</html>