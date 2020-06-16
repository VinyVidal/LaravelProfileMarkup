{{--
    Profile Page Template View
--}}

{{--                   PARAMETERS 
    string @user -> Logged User
--}}

@extends('templates/master')

@section('title')
    @yield('title')
@endsection

@section('content')

    {{-- Edit Profile Modal --}}
    <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModal" aria-hidden="true">
        <div class="modal-dialog">
          <div class="modal-content">
            <div class="modal-header">
              <h3 class="modal-title">Editar Perfil</h3>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            
                    <h4 class="modal-title mb-2">Foto de Perfil</h4>
                    {{-- avatar picker --}}
                    @include('templates.form.picture', ['name' => 'uploadedPhoto', 'id' => 'photo', 'class' => 'img-thumbnail size-m rounded-circle', 'placeholder' => $user->photo])

                <h4 class="modal-title mb-2">Foto de Capa</h4>
                    {{-- cover picker --}}
                    @include('templates.form.picture', ['name' => 'uploadedCover', 'id' => 'cover', 'class' => 'size-rectangle-m border rounded bg-cover', 'placeholder' => $user->cover ?? asset('img/default-cover.png')])

                <h4 class="modal-title mb-2">Biografia/Apresentação</h4>
                @include('templates.form.textarea', ['name' => 'bio', 'rows' => 6, 'value' => $user->bio])

            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
              <button type="button" class="btn btn-primary">Salvar Alterações</button>
            </div>
          </div>
        </div>
      </div>{{-- Edit Profile Modal --}}
    
    @include('navbar', ['username' => $user->username  ?? null , 'useravatar' => $user->photo  ?? null ])
    <div class="profile-page">
        <div class="profile-background">
            <div class="profile-avatar-container">
                <img src="{{ $user->photo ?? asset('img/default-avatar.png') }}" alt="Foto de Perfil" class="img-thumbnail rounded-circle">
                <h2 class="mt-3">{{ $user->fullName  ?? 'null'  }}</h2>
                <div class="action-buttons">
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal"><i class="fas fa-edit"></i> Editar Perfil</button>
                </div>
            </div><!-- profile-avatar-container -->
        </div><!-- profile-background -->
        

        <div class="container my-3">
            <div class="row">
                <div class="col h-100 col-md-3 bg-light mr-5 px-0">
                  <h4 class="text-center my-0 border-bottom border-main bg-main text-main py-2">Navegação</h4>
                    <ul class="nav flex-column profile-nav">
                        <li class="nav-item">
                          <a class="nav-link{{ Route::currentRouteName() == 'user.profile' || Route::currentRouteName() == 'user.profile.activity' ? ' active' : '' }} text-body border-bottom" scroll="#profile-content" href="{{ route('user.profile.activity') }}">Atividade</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link{{ Route::currentRouteName() == 'user.profile.about' ? ' active' : '' }} text-body border-bottom" scroll="#profile-content" href="{{ route('user.profile.about') }}">Sobre</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link{{ Route::currentRouteName() == 'user.profile.friends' ? ' active' : '' }} text-body border-bottom" scroll="#profile-content" href="{{ route('user.profile.friends') }}">Amigos</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-body" href="#">Configurações</a>
                        </li>
                      </ul><!-- profile-nav -->
                </div><!-- col -->
                <div id="profile-content" scrollTo class="col ml-5 bg-light p-0 rounded">
                    @yield('inner-content')
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- profile-page -->
@endsection

@section('additional-js')
    <script src="{{ asset('js/profile-pic.js') }}"></script>
    @if (Route::currentRouteName() != 'user.profile')
      <script src="{{ asset('js/scrollToElement.js') }}"></script>
    @endif
@endsection