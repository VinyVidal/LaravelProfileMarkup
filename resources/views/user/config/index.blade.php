@extends('templates/page/default')

@section('title')
    Início
@endsection

@section('inner-content')
    <div class="p-3 px-5">
        <h2 class="mb-3"> Configurações</h2>

        {!! Form::model(Auth::user(), ['route' => 'user.config.update', 'method' => 'post']) !!}
        <h3>Informações</h3>
        <div class="form-row">
            <div class="col-6">
                @include('templates.form.input', ['name' => 'fullName', 'label' => 'Nome'])
            </div>
            @if ($user->socials->count() === 0)
                <div class="col-6">
                    @include('templates.form.input', ['type' => 'email', 'name' => 'email', 'label' => 'Email'])
                </div>
            @endif
            <div class="col-6">
                @include('templates.form.date', ['name' => 'birth', 'label' => 'Data de Nascimento'])
            </div>
        </div>
        @if ($user->socials->count() === 0)
            <h3>Mudar Senha</h3>
            <div class="form-row">
                <div class="col-6">
                    @include('templates.form.password', ['name' => 'oldPassword', 'label' => 'Senha Atual'])
                </div>
                <div class="col-6"></div>
                <div class="col-6">
                    @include('templates.form.password', ['name' => 'newPassword', 'label' => 'Nova Senha'])
                </div>
                <div class="col-6">
                    @include('templates.form.password', ['name' => 'confirmPassword', 'label' => 'Confirmar Nova Senha'])
                </div>
            </div>
        @endif
        @include('templates.form.errors', ['fields' => ['fullName', 'email', 'birth', 'oldPassword', 'newPassword', 'confirmPassword'], 'bag' => 'user_update'])
        <div class="text-right">
            @include('templates.form.submit', ['name' => 'Salvar'])
        </div>
        {!! Form::close() !!}
    </div>
@endsection