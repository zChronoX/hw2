@extends('layouts/header')

@section('titolo', "Feedback")




<head>
    <link rel="stylesheet" href="{{ url('css/create_post.css') }}">
    <script src="{{ url('js/feedback.js') }}" defer="true"></script>
</head>
@section('contenuto')

@if (session('success'))
<span class="success">{{ session('success')}}</span>
@endif


<form class='type_zero' name='form_post' method="POST" action="{{ url('feedback/send_feedback') }}">
            @csrf

            <h1>Scrivi qui il tuo feedback!</h1>
            <label><input type='text' name='Nome' class="TitleBox" placeholder="Nome" id="titolo" value='{{ old("nome") }}' required></label>
            <span id="Title"></span>
            <label><input type='text' name='Cognome' class="TitleBox" placeholder="Cognome" id="titolo" value='{{ old("cognome") }}' required></label>
            <span id="Title"></span>
            <label><textarea name='Testo' class="textBox" placeholder="Inserisci qui il tuo feedback"
                    id="testo" value='{{ old("testo") }}' required></textarea></label>
            <span id="main_text"></span>
            <div id="zero"><input type='submit' value='Invia'></div>

    </section>
    </form>

@endsection
