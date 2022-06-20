@extends('layouts/header')

@section('titolo', "News")
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100&display=swap" rel="stylesheet">
    <link rel="stylesheet" href='{{ url('css/news.css') }}'>
    <script>
        const BASE_URL = "{{ url('/') }}/";
    </script>
    <script src='{{ url('js/news.js') }}' defer="true"></script>
</head>

@section('contenuto')


    <p id="posts_title"> Qui puoi trovare le ultime news/recensioni da parte del nostro staff!<br>
    </p>
    <section id="news">
    </section>
@endsection
