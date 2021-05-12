@extends('templates/page/profile', ['user' => $user])

@section('title')
    Amigos de {{ $user->fullName }}
@endsection

@section('inner-content')
<h4 class="text-center mt-0 border-bottom border-main bg-main text-main py-2">Amigos</h4>
<ul class="nav nav-tabs text-center border-bottom flex-column flex-md-row" role="tablist" id="friendsTab">
    <li class="col nav-item">
        <a class="nav-link active border-bottom" id="followers-tab" role="tab" data-toggle="tab" href="#followers" aria-controls="followers" aria-selected="true">Seguidores</a>
    </li>
    <li class="col nav-item">
        <a class="nav-link" id="following-tab" role="tab" data-toggle="tab" href="#following" aria-controls="following" aria-selected="false">Seguindo</a>
    </li>
</ul>
<div class="tab-content px-1  py-2" id="friendsTabContent">
    <div class="tab-pane fade show active container" role="tabpanel" id="followers" aria-labelledby="followers-tab">
        @if (count($followers) > 0)
            <div class="row mt-3">
            @foreach ($followers as $key => $u)
                <div class="col-lg-6 {{ $key > 0 ? 'mt-4 mt-lg-0' : '' }}">
                    <a href="{{route('user.profile', $u->follower->username)}}"><img src="{{ asset($u->follower->photo) }}" alt="user-avatar" class="size-sm rounded-circle mr-3"> <span class="link-body-underline font-weight-bold">{{ $u->follower->fullName }}</span></a>
                </div><!--col-->
            @endforeach
        </div><!--row-->
        @else
            <p>Nenhum seguidor.</p>
        @endif
        
    </div><!--tab followers-->

    <div class="tab-pane fade container" role="tabpanel" id="following" aria-labelledby="following-tab">
        @if (count($followeds) > 0)
            <div class="row mt-3">
            @foreach ($followeds as $key => $u)
                <div class="col-lg-6 {{ $key > 0 ? 'mt-4 mt-lg-0' : '' }}">
                    <a href="{{route('user.profile', $u->followed->username)}}"><img src="{{ asset($u->followed->photo) }}" alt="user-avatar" class="size-sm rounded-circle mr-3"> <span class="link-body-underline font-weight-bold">{{ $u->followed->fullName }}</span></a>
                </div><!--col-->
            @endforeach
        </div><!--row-->
        @else
            <p>Nenhum usuário seguido.</p>
        @endif
        
    </div><!--tab followers-->
</div>
@endsection