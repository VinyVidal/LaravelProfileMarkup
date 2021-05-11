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
    @if (!$visitor)
        {{-- Edit Profile Modal --}}
        <div class="modal fade" id="editProfileModal" tabindex="-1" role="dialog" aria-labelledby="editProfileModal" aria-hidden="true">
          <div class="modal-dialog m-0 mx-md-auto my-md-4">
            <div class="modal-content">
              <div class="modal-header">
                <h3 class="modal-title">Editar Perfil</h3>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
              
                {!! Form::model(session()->get('user'), ['route' => 'user.profile.edit', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}
                <h4 class="modal-title mb-1 mb-2">Foto de Perfil</h4>
                {{-- avatar picker --}}
                @include('templates.form.picture', ['name' => 'uploadedPhoto', 'id' => 'photo', 'class' => 'img-thumbnail size-m rounded-circle', 'placeholder' => $user->photo ?? asset('img/default-avatar.png')])

                <h4 class="modal-title mb-2">Foto de Capa</h4>
                    {{-- cover picker --}}
                    @include('templates.form.picture', ['name' => 'uploadedCover', 'id' => 'cover', 'class' => 'size-rectangle-m border rounded bg-cover', 'placeholder' => $user->cover ?? asset('img/default-cover.png')])

                <h4 class="modal-title mb-2">Biografia/Apresentação</h4>
                @include('templates.form.textarea', ['name' => 'bio', 'rows' => 6, 'value' => $user->bio ?? "", 'attributes' => ['placeholder' => 'Escreva sua apresentação...']])

                {{-- <div class="alert alert-success" role="alert">
                  A simple success alert—check it out!
                </div> --}}

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                @include('templates.form.submit', ['name' => 'Salvar Alterações', 'class' => 'btn-primary'])
                {!! Form::close() !!}
              </div>
            </div>
          </div>
        </div>{{-- Edit Profile Modal --}}
    @endif
    
    @include('navbar', ['username' => Auth::user()->username  ?? null , 'useravatar' => Auth::user()->photo  ?? null ])
    <div class="profile-page">
      <div class="profile-background" style="background-image: url('{{ $user->cover }}');">
            <div class="profile-avatar-container">
                <img src="{{ $user->photo ?? asset('img/default-avatar.png') ?? asset('img/default-avatar.png') }}" alt="Foto de Perfil" class="img-thumbnail rounded-circle">
                <h2 class="mt-3">{{ $user->fullName  ?? 'null'  }}</h2>
                <div class="action-buttons">
                  @if (!$visitor)
                    <button class="btn btn-primary" data-toggle="modal" data-target="#editProfileModal"><i class="fas fa-edit"></i> Editar Perfil</button>
                  @else
                    @if (Auth::user()->followsUser($user))
                      <button class="btn btn-primary" title="Deixar de seguir"><i class="fas fa-check"></i> Seguindo</button>  
                    @else
                      <button class="btn btn-outline-primary" onclick="window.location.href='{{ route('user.follow', ['follower_id' => Auth::user()->id, 'followed_id' => $user->id]) }}'"><i class="fas fa-eye"></i> Seguir</button>
                    @endif
                  @endif
                </div>
            </div><!-- profile-avatar-container -->
        </div><!-- profile-background -->
        

        <div class="container my-3">
            <div class="row">
              <div class="col">
                @if (session('message'))
                    <div class="alert alert-{{ session('success') == true ? 'success' : 'danger' }}" role="alert">
                      {{ session('message') }}
                      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                  @endif
              </div>
            </div>
            <div class="row">
                <div class="h-100 col-md-3 bg-light mr-md-5 px-0">
                  <h4 class="text-center my-0 border-bottom border-main bg-main text-main py-2">Navegação</h4>
                    <ul class="nav flex-column profile-nav">
                        <li class="nav-item">
                          <a class="nav-link{{ Route::currentRouteName() == 'user.profile' || Route::currentRouteName() == 'user.profile.activity' ? ' active' : '' }} text-body border-bottom" scroll="#profile-content" href="{{ route('user.profile.activity', $visitor ? $user->username : null) }}">Atividade</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link{{ Route::currentRouteName() == 'user.profile.about' ? ' active' : '' }} text-body border-bottom" scroll="#profile-content" href="{{ route('user.profile.about', $visitor ? $user->username : null) }}">Sobre</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link{{ Route::currentRouteName() == 'user.profile.friends' ? ' active' : '' }} text-body border-bottom" scroll="#profile-content" href="{{ route('user.profile.friends', $visitor ? $user->username : null) }}">Amigos</a>
                        </li>
                        <li class="nav-item">
                          <a class="nav-link text-body" href="#">Configurações</a>
                        </li>
                      </ul><!-- profile-nav -->
                </div><!-- col -->
                <div id="profile-content" scrollTo class="col-md ml-md-5 mt-3 mt-md-0 bg-light p-0 rounded">
                    @yield('inner-content')
                </div><!-- col -->
            </div><!-- row -->
        </div><!-- container -->
    </div><!-- profile-page -->
@endsection

@section('additional-js')
    <script src="{{ asset('js/profile-pic.js') }}"></script>
    <script src="{{ asset('js/file-input.js') }}"></script>
    <script src="{{ asset('js/post-edit-modal.js') }}"></script>
    @if (Route::currentRouteName() != 'user.profile')
      <script src="{{ asset('js/scrollToElement.js') }}"></script>
    @endif
@endsection