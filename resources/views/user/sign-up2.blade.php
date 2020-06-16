@extends('templates.page.user-auth')

@section('title')
    Cadastro
@endsection

@section('inner.content')
    <h3 class="text-center">Perfil</h3>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb p-2">
            <li class="breadcrumb-item"><a href="{{ route('user.sign-up.step1') }}" class="text-main">Dados pessoais</a></li>
            <li class="breadcrumb-item active">Social</li>
            <li class="breadcrumb-item">
                @if (session()->get('sign-up_step2'))
                    <a href="{{ route('user.sign-up.step3') }}" class="text-main">Conta</a>
                @else
                    Conta
                @endif
            </li>
        </ol>
    </nav>
    {{-- <img src="{{ asset('storage/'.$photo) ?? 'erro' }}"> --}}
    {!! Form::model(session()->get('user'), ['route' => 'user.sign-up.step2.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
    @include('templates.form.picture', ['name' => 'uploadedPhoto', 'id' => 'photo', 'label' => 'Escolha uma foto para o seu perfil', 'class' => 'img-thumbnail size-m rounded-circle', 'placeholder' => $photo])
    @include('templates.form.textarea', ['name' => 'bio', 'label' => 'Conte-nos mais sobre você', 'rows' => 6])
    <a href="{{ route('user.sign-up.step1') }}" class="btn btn-secondary float-left">Voltar</a>
    @include('templates.form.submit', ['name' => 'Continuar', 'class' => 'btn-info float-right'])
    <div class="clear"></div>
    @include('templates.form.errors', ['fields' => ['uploadedPhoto', 'bio'], 'class' => 'alert alert-danger py-2 my-2'])
    {!! Form::close() !!}
@endsection

@section('additional-js')
    <script src="{{ asset('js/profile-pic.js') }}"></script>
@endsection