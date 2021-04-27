@extends('templates/page/default')

@section('title')
    Início
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
        <h2 class="pl-md-4 mb-md-3">{{ $message ?? 'Seja bem-vindo, '.$user->username.'!' }} </h2>
        @include('post.create')
    </div>
@endsection