@extends('layouts/header')

@section('titolo', "Crea Post")

<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="stylesheet" href='{{ url('css/create_post.css') }}'>
    <script>
        const BASE_URL = "{{ url('/') }}/";
    </script>
    <script src='{{ url('js/create_post.js') }}' defer="true"></script>
</head>


@section('contenuto')
    <section id="newpost">
            @if($error == 'short_title')
            <span class='errore'>Inserisci un titolo di almeno 4 caratteri!</span>
            @elseif($error == 'short_text')
            <span class='errore'>Inserisci un testo di almeno 10 caratteri!</span>
            @endif
        <form class='type_zero' name='form_post' method="POST" action="{{ url('create') }}">
            @csrf

            <h1>Scrivi qui un nuovo post!</h1>
            <label><input type='text' name='Titolo' class="TitleBox" placeholder="Titolo" id="titolo" value='{{ old("titolo") }}'></label>
            <span id="Title"></span>
            <label><textarea name='Testo' class="textBox" placeholder="Inserisci qui il testo"
                    id="testo" value='{{ old("testo") }}'></textarea></label>
            <span id="main_text"></span>
            <div id="zero"><input type='submit' value='Invia'></div>

    </section>
    </form>
@endsection