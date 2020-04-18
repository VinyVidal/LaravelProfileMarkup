{{-- 
    string @username -> User display name
    string @useravatar -> User photo path
--}}
<nav class="navbar navbar-expand-lg bg-main text-main border-main">
    <a class="navbar-brand" href="#">Brand</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-content" aria-controls="navbar-content" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
  
    <div class="collapse navbar-collapse" id="navbar-content">
      <ul class="navbar-nav mr-auto link-main">
        <li class="nav-item active">
          <a class="nav-link" href="#">Página Inicial <span class="sr-only">(current)</span></a>
        </li>
      </ul>
      <div class="inline my-2 my-lg-0 mx-5">
        <div class="dropdown">
          <a href="#" role="button" id="navbar-useravatar" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img src="{{ $useravatar ?? asset('img/default-avatar.png') }}" class="img size-xs rounded-circle">
          </a>
        
          <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbar-useravatar">
            <h5 class="ml-3">{{ $username ?? 'user' }}</h5>
            <hr>
            <a class="dropdown-item" href="#">Meu Perfil</a>
            <a class="dropdown-item" href="#">Configurações</a>
            <a class="dropdown-item" href="{{ route('user.logout') }}">Logout</a>
          </div>
        </div>
      </div>
    </div>
  </nav>