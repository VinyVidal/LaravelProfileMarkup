@extends('templates.page.user-auth')

@section('title')
    Cadastro
@endsection

@section('inner.content')
    <h3 class="text-center">Criar Nova Conta</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-2">
            <li class="breadcrumb-item active">Dados pessoais</li>
            <li class="breadcrumb-item">
                @if (session()->get('sign-up_step1'))
                    <a href="{{ route('user.sign-up.step2') }}" class="text-main">Social</a>
                @else
                    Social
                @endif
            </li>
            <li class="breadcrumb-item">
                @if (session()->get('sign-up_step2'))
                    <a href="{{ route('user.sign-up.step3') }}" class="text-main">Conta</a>
                @else
                    Conta
                @endif
            </li>
        </ol>
    </nav>
    {!! Form::model(session()->get('user'), ['route' => 'user.sign-up.step1.store', 'method' => 'post']) !!}
    @include('templates.form.input', ['name' => 'fullName', 'label' => 'Nome Completo'])
    
    @include('templates.form.input', ['name' => 'email', 'type' => 'email','label' => 'Email'])
    @include('templates.form.date', ['name' => 'birth', 'label' => 'Data de Nascimento'])
    <div class="text-right">
        @include('templates.form.submit', ['name' => 'Continuar', 'class' => 'btn-info mb-2'])
    </div>
    @include('templates.form.errors', ['fields' => ['fullName', 'email', 'birth'], 'class' => 'alert alert-danger py-2 my-2'])
    {!! Form::close() !!}
    <p class="mt-2">Já possui uma conta? <a href="{{ route('user.login') }}" class="link-main">Clique aqui</a> e para entrar!</p>
@endsection