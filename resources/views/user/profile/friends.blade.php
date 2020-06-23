@extends('templates/page/profile', ['user' => $user])

@section('title')
    Amigos de {{ $user->fullName }}
@endsection

@section('inner-content')
<h4 class="text-center mt-0 border-bottom border-main bg-main text-main py-2">Amigos</h4>
<ul class="nav nav-tabs text-center border-bottom flex-column flex-md-row" role="tablist" id="friendsTab">
            <li class="col nav-item">
                <a class="nav-link active border-bottom" id="allFriends-tab" role="tab" data-toggle="tab" href="#allFriends" aria-controls="allFriends" aria-selected="true">Todos Amigos</a>
            </li>
            <li class="col nav-item">
                <a class="nav-link" id="commonFriends-tab" role="tab" data-toggle="tab" href="#commonFriends" aria-controls="commonFriends" aria-selected="false">Amigos em Comum</a>
            </li>
</ul>
<div class="tab-content px-1  py-2" id="friendsTabContent">
    <div class="tab-pane fade show active container" role="tabpanel" id="allFriends" aria-labelledby="allFriends-tab">
        <div class="row mt-3">
            <div class="col">
                <a href="#"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-sm rounded-circle mr-3"> <span class="link-body-underline font-weight-bold">Some Friend</span></a>
            </div><!--col-->
            <div class="col-md mt-4 mt-md-0">
                <a href="#"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-sm rounded-circle mr-3"> <span class="link-body-underline font-weight-bold">Some Friend</span></a>
            </div><!--col-->
        </div><!--row-->
    </div><!--tab allFriends-->



    <div class="tab-pane fade container" role="tabpanel" id="commonFriends" aria-labelledby="commonFriends-tab">
        <div class="row mt-3">
            <div class="col">
                <a href="#"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-sm rounded-circle mr-3"> <span class="link-body-underline font-weight-bold">Common Friend</span></a>
            </div><!--col-->
            <div class="col-md mt-4 mt-md-0">
                <a href="#"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-sm rounded-circle mr-3"> <span class="link-body-underline font-weight-bold">Common Friend</span></a>
            </div><!--col-->
        </div><!--row-->
    </div><!--tab allFriends-->
</div>
@endsection