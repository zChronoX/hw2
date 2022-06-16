<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title> GTech Tips</title>
    <link rel="shortcut icon" type="image/x-icon" href='{{ url('images/logo.png') }}'  />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href='{{ url('css/home.css') }}'>
    <script>
        const BASE_URL = "{{ url('/') }}/";
    </script>
    <script src='{{ url('js/home.js') }}' defer="true"></script>
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

    <main class="fixed">
        <section id="profile">
            <div class="welcome">
                <p>Bentornato!</p>
            </div>
            <div class="name">
                 {{ $user['nome'] }} {{ $user['cognome'] }}
            </div>
            <div class="username">
            {{ '@'.$user['username'] }} 
            </div>

    </main>

    <a id=userinfo>Info Toggle</a>


    <section id="posts">
        <p id="posts_title"> Benvenuto su GTech Tips! 🖥️
            <br> Il forum che riguarda Hardware, Software e molto altro!
            <br>Scrivi un post cliccando in alto e leggi gli ultimi qui di seguito!
        </p>
    </section>
    <section id="s_posts">
        <form id="search_posts" name="posts_form" method="GET">
            @csrf
            <p id="search_p"> Non trovi un post? Cercalo qui sotto! </p>
            <input type='text' name='search_post' placeholder='Cerca post' id="search_ps">
            <input type="submit" value="Cerca">
            <div id="a2" class="hidden"></div>
    </section>
    </form>
</body>
<footer>
    <form id="spotify" name="form_post" method="GET">
        @csrf
        <div class="api">
            <p>Non ci sono più post da visualizzare!</p>
            <p>Leggere i post ti ha fatto venire voglia di musica?<br>
                O cerchi un'ispirazione per un nuovo post?<br>
                Cerca qui sotto il brano che vuoi!</p>
            <input type="text" id="track" placeholder="Cerca su Spotify!" />
            <input type="submit" value="Cerca">
            <div id="a1">
            </div>
            <div>
    </form>
</footer>

</html>