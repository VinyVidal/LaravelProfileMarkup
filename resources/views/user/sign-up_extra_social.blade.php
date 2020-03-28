{{-- 
    --------------------
       Page for completing profile after signin up with a social media (Google, Facebook)
    --------------------
--}}
@extends('templates.page.user-auth')

@section('title')
    Complete o seu perfil | Profile Markup
@endsection

@section('inner.content')
    <h3 class="text-center">Dados adicionais</h3>
    <p> Seu cadastro está quase finalizado, só falta preencher as seguintes informações e pronto!</p>

    {!! Form::open(['route' => $route, 'method' => 'post']) !!}
    @include('templates.form.date', ['name' => 'birthday', 'label' => 'Data de Nascimento'])
    <div class="text-right">
        @include('templates.form.submit', ['name' => 'Continuar', 'class' => 'btn-info mb-2'])
    </div>
    @include('templates.form.errors', ['fields' => ['birthday'], 'class' => 'alert alert-danger py-2 my-2'])
    {!! Form::close() !!}
@endsection