@extends('layouts/header')

@section('titolo', "Preferiti")




<head>
    <link rel="stylesheet" href='{{ url('css/favorite.css') }}'>
    <script src='{{ url('js/favorite.js') }}' defer="true"></script>
</head>


@section('contenuto')
    <section id="posts">
        <p id="posts_title"> Qui puoi trovare tutti i post a cui ai messo il Like!
        </p>
    </section>
@endsection
