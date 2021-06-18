@extends('templates/page/profile', ['user' => $user])

@section('title')
    {{ $user->fullName }}
@endsection

@section('inner-content')
    <h4 class="text-center mt-0 border-bottom border-main bg-main text-main py-2">Atividade Recente</h4>
    <div class="px-0 px-md-3 py-2">
        @if ($user->id == Auth::user()->id)
            @include('post.create', ['user' => $user])
        @endif
        @include('post.edit')

        {{-- Post listing --}}
        @if ((count($activities) > 0))
            @foreach ($activities as $activity)
                @if ($activity->post->visible(Auth::user()))
                    <p class="mb-1 mt-3 bg-lgray p-3">{!! $activity->description !!}</p>
                    @include('post.index', ['post' => $activity->post])
                @endif
            @endforeach
        @else
            Nenhuma atividade
        @endif
    </div>
    
@endsection