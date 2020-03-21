@extends('templates.page.user-auth')

@section('title')
    Cadastro
@endsection

@section('inner.content')
    <h3 class="text-center">Criar Nova Conta</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-2">
            <li class="breadcrumb-item"><a href="{{ route('user.sign-up.step1') }}" class="text-main">Dados pessoais</a></li>
            <li class="breadcrumb-item"><a href="{{ route('user.sign-up.step2') }}" class="text-main">Social</a></li>
            <li class="breadcrumb-item active">Conta</li>
        </ol>
    </nav>
    {!! Form::open(['route' => 'user.sign-up.step3.store', 'method' => 'post']) !!}
    @include('templates.form.input', ['name' => 'username', 'label' => 'Nome de usuário'])
    @include('templates.form.password', ['name' => 'password', 'label' => 'Senha'])
    @include('templates.form.password', ['name' => 'confirmPassword', 'label' => 'Confirmar Senha'])
    <a href="{{ route('user.sign-up.step2') }}" class="btn btn-secondary">Voltar</a>
    @include('templates.form.submit', ['name' => 'Criar Conta', 'class' => 'btn-info float-right'])
    @include('templates.form.errors', ['fields' => ['username', 'password', 'confirmPassword'], 'class' => 'alert alert-danger py-2 my-2'])
    {!! Form::close() !!}
@endsection