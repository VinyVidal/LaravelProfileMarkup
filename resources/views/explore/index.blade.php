@extends('templates/page/default')

@section('title')
    Explorar
@endsection

@section('inner-content')
    @if (session('message'))
    <div class="alert alert-success" role="alert">
        {{ session('message') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif
    <div class="p-3">
        <h2 class="pl-md-4 mb-md-3">Encontre novos contatos!</h2>

        @foreach ($users as $user)
        <div class="row mt-3 ml-3">
            <div class="col">
                <a href="#"><img src="{{ asset($user->photo) }}" alt="user-avatar" class="size-sm rounded-circle mr-3"> <span class="link-body-underline font-weight-bold">{{ $user->fullName }}</span></a>
            </div><!--col-->
        </div><!--row-->            
        @endforeach
    </div>
@endsection