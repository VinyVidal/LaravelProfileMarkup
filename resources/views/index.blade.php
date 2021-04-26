@extends('templates/master')

@section('title')
    Titulo
@endsection

@section('content')
    @include('navbar', ['username' => $user->username, 'useravatar' => $user->photo])
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <h1>{{ $message ?? 'Seja bem-vindo, '.$user->username.'!' }} </h1>
    @include('post.create')
@endsection

@section('additional-js')
    <script src="{{ asset('js/file-input.js') }}"></script>
@endsection