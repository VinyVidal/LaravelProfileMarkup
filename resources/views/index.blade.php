@extends('templates/master')

@section('title')
    Titulo
@endsection

@section('content')
    {{ $user->username }}
@endsection