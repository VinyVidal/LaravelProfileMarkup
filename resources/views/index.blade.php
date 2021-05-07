@extends('templates/page/default')

@section('title')
    Início
@endsection

@section('inner-content')
    <div class="p-3">
        <h2 class="pl-md-4 mb-md-3">{{ $message ?? 'Seja bem-vindo, '.$user->username.'!' }} </h2>
        @include('post.create')
    </div>
@endsection