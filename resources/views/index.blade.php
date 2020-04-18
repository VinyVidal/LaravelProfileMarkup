@extends('templates/master')

@section('title')
    Titulo
@endsection

@section('content')
    @include('templates/navbar', ['username' => $user->username, 'useravatar' => $user->photo])
    <h1>{{ $message ?? 'Seja bem-vindo, '.$user->username.'!' }} </h1>
@endsection