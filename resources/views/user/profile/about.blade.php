@extends('templates/page/profile', ['user' => $user])

@section('title')
    Sobre {{ $user->fullName }}
@endsection

@section('inner-content')
<h4 class="text-center mt-0 border-bottom border-main bg-main text-main py-2">Biografia</h4>
<div class="px-1 px-md-5 py-2">
    <p class="user-bio border border-secondary rounded bg-lgray p-2 p-md-3">{{ nl2br($user->bio) }}</p>
</div>
@endsection