@extends('templates/master')

@section('title')
    Titulo
@endsection

@section('content')
    <h1>{{ $message ?? "Inicio" }}</h1>
    {{ $user->username }} <br>
    <img id="profile-picture" src="{{ $user->socials->first()->social_avatar ?? null }}" alt="default-avatar" class="img-thumbnail"> <br>
    <img id="profile-picture" src={{asset($user->photo)}} alt="default-avatar" class="img-thumbnail"> <br>
    <a href=""></a>
@endsection