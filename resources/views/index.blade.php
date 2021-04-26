@extends('templates/master')

@section('title')
    Titulo
@endsection

@section('content')
    @include('navbar', ['username' => $user->username, 'useravatar' => $user->photo])
    <h1>{{ $message ?? 'Seja bem-vindo, '.$user->username.'!' }} </h1>
    @include('post.create')
@endsection

@section('additional-js')
    <script src="{{ asset('js/file-input.js') }}"></script>
@endsection