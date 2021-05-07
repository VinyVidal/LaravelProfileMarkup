@extends('templates/page/profile', ['user' => $user])

@section('title')
    {{ $user->fullName }}
@endsection

@section('inner-content')
    <h4 class="text-center mt-0 border-bottom border-main bg-main text-main py-2">Atividade Recente</h4>
    <div class="px-0 px-md-3 py-2">
        @include('post.create', ['user' => $user])
        @include('post.edit')

        {{-- Post listing --}}
        @if ((count($posts) > 0))
            @foreach ($posts as $post)
                @include('post.index', ['post' => $post])
            @endforeach
        @else
            Nenhuma atividade
        @endif
    </div>
    
@endsection