@extends('templates/page/default')

@section('title')
    Titulo
@endsection

@section('inner-content')
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="p-3">
        <h1>{{ $message ?? 'Seja bem-vindo, '.$user->username.'!' }} </h1>
        @include('post.create')
    </div>
@endsection