{{--
    Main Navigational Menu template
--}}

{{--                   PARAMETERS 
    string @username -> Logged User display name
    string @useravatar -> Logged User photo path
--}}
<nav class="navbar navbar-expand-sm bg-main text-main border-main">
<a class="navbar-brand" href="#"><img class="img-thumbnail border-dark size-sm bg-light" src="{{ asset('img/logo.png') }}" alt=""></a>

    {{-- ARRUMAR O PROFILE MENU NA NAVBAR ---- DEIXAR BUNITINHO!!!!
      COMENTAR O FINAL DAS TAGS ANINHADAS --}}
  <button class="navbar-toggler text-light" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fas fa-bars"></i>
  </button>

    <div class="collapse navbar-collapse" id="navbar-content">
      <ul class="navbar-nav mr-auto link-main">
        <li class="nav-item active">
          <a class="nav-link" href="#">Página Inicial <span class="sr-only">(current)</span></a>
        </li>
        {{-- Profile Menu MOBILE --}}
        <li class="nav-item mobile-sm">
          <a class="nav-link" data-toggle="collapse" href="#profileMobileCollapse" aria-expanded="false" aria-controls="profileMobileCollapse">
            Minha Conta - {{ $username }} 
          </a>
          <div class="collapse" id="profileMobileCollapse">
            <a class="dropdown-item" href="#">Meu Perfil</a>
          <a class="dropdown-item" href="#">Configurações</a>
          <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
          </div>
        </li>
        {{-- Profile Menu MOBILE --}}
        
      </ul><!-- navbar-nav -->
      {{-- Profile Menu DESKTOP --}}
      <div class="dropdown desktop-sm">
        <a href="#" role="button" id="navbar-useravatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <img src="{{ $useravatar ?? asset('img/default-avatar.png') }}" class="img size-sm rounded-circle">
        </a>
      
        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-useravatar">
          <h5 class="ml-3">{{ $username ?? 'user' }}</h5>
          <hr>
          <a class="dropdown-item" href="#">Meu Perfil</a>
          <a class="dropdown-item" href="#">Configurações</a>
          <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
        </div><!-- dropdown-menu -->
      </div><!-- dropdown -->
      {{-- Profile Menu DESKTOP--}}
    </div><!-- collapse -->
  </nav>