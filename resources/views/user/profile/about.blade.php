@extends('templates/page/profile', ['user' => $user])

@section('title')
    Sobre {{ $user->fullName }}
@endsection

@section('inner-content')
<h4 class="text-center mt-0 border-bottom border-main bg-main text-main py-2">Biografia</h4>
<div class="px-1 px-md-5 py-2">
    @if (isset($user->bio))
    <p class="user-bio border border-secondary rounded bg-light p-2 p-md-3">{!! nl2br($user->bio) !!}</p>
    @else
    <p class="user-bio text-center p-2 p-md-3"><a class="text-secondary" href="#" data-toggle="modal" data-target="#editProfileModal"> Clique aqui para adicionar uma apresentação sobre você!</a></p>
    @endif
</div>
@endsection