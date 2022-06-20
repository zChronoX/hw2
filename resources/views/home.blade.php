@extends('layouts/header')

@section('titolo', "GTech Tips")

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href="{{ url('css/home.css') }}">
    <script>
        const BASE_URL = "{{ url('/') }}/";
    </script>
    <script src="{{ url('js/home.js') }}" defer="true"></script>
</head>


@section('contenuto')
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

@endsection