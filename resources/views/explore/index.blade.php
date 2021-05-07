@extends('templates/page/default')

@section('title')
    Explorar
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
        <h2 class="pl-md-4 mb-md-3">Encontre novos contatos!</h2>
    </div>
@endsection