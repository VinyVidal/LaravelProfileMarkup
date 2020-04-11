@extends('templates.page.user-auth')

@section('title')
    Login
@endsection

@section('inner.content')
    <h3 class="text-center">Entrar no Profile Markup</h3>
    {!! Form::open(['route' => 'user.doLogin', 'method' => 'post']) !!}
    @include('templates.form.input', ['name' => 'email', 'type' => 'email','label' => 'Email'])
    @include('templates.form.password', ['name' => 'password','label' => 'Senha'])
    @include('templates.form.checkbox', ['name' => 'remember', 'value' => 1, 'checked' => false, 'label' => 'Lembrar meu login'])
    @include('templates.form.submit', ['name' => 'Entrar', 'class' => 'btn-info'])
    {!! Form::close() !!}
    <p class="mt-2">Não tem uma conta? <a href="{{ route('user.sign-up.step1') }}" class="link-main">Clique aqui</a> e crie uma agora!</p>
    <h4 class="text-center"> ------ OU ------</h3>
    <a href="{{ route('auth.google.redirect') }}" class="btn btn-primary mx-auto">Entrar com Google</a>
@endsection