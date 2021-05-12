@extends('templates/page/default')

@section('title')
    Explorar
@endsection

@section('inner-content')
    <div class="p-3">
        <h2 class="pl-md-4 mb-md-3">Encontre novos contatos!</h2>

        {!! Form::open(['method' => 'get']) !!}
        <div class="ml-3 form-inline">
            <div class="form-group">
                <input type="search" class="form-control" name="search" value="{{ request('search', null) }}">
                <button class="form-control btn btn-primary ml-3" type="submit">Buscar</button>
            </div>
        </div>
        {!! Form::close() !!}

        @if (count($users) > 0)
            @foreach ($users as $user)
            <div class="row mt-3 ml-3">
                <div class="col">
                    <a href="{{route('user.profile', $user->username)}}"><img src="{{ asset($user->photo) }}" alt="user-avatar" class="size-sm rounded-circle mr-3"> <span class="link-body-underline font-weight-bold">{{ $user->fullName }}</span></a>
                </div><!--col-->
                <div class="col text-right">
                    @if (Auth::user()->followsUser($user))
                    <button class="btn btn-primary" onclick="window.location.href='{{ route('user.unfollow', ['follower_id' => Auth::user()->id, 'followed_id' => $user->id]) }}'" title="Deixar de seguir"><i class="fas fa-check"></i> Seguindo</button>  
                    @else
                        <button class="btn btn-outline-primary" onclick="window.location.href='{{ route('user.follow', ['follower_id' => Auth::user()->id, 'followed_id' => $user->id]) }}'"><i class="fas fa-eye"></i> Seguir</button>
                    @endif
                </div>
            </div><!--row-->            
        @endforeach
        @else
            <p class="mt-2 p-3 ml-2">Nenhum usuário encontrado</p>
        @endif
        
    </div>
@endsection