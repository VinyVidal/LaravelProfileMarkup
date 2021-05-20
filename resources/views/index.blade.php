@extends('templates/page/default')

@section('title')
    Início
@endsection

@section('inner-content')
    <div class="p-3">
        <h2 class="pl-md-4 mb-md-3">{{ $message ?? 'Seja bem-vindo, '.$user->username.'!' }} </h2>
        @include('post.create')

        {{-- Post listing --}}
        @if ((count($posts) > 0))
            @foreach ($posts as $post)
                @include('post.index', ['post' => $post])
            @endforeach
        @else
            Nenhuma atividade
        @endif
    </div>

    @include('post.edit')
@endsection

@section('additional-js')
    <script src="{{ asset('js/post-edit-modal.js') }}"></script>
    <script src="{{ asset('js/post-comment-edit-modal.js') }}"></script>
@endsection