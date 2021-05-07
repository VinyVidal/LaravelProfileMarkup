{{-- 
    Individual post component used for listing    
--}}

{{--                   PARAMETERS 
  * Model Post @post - The post model
    
    *required
--}}

@php
    $user = $post->user;
    $errorBagName = 'post_update'.$post->id;
@endphp
@if (count($errors->$errorBagName) > 0)
    <div class="d-none" id="errors">
        @include('templates.form.errors', ['fields' => ['visibility', 'uploadedMedia', 'text', 'user_id'], 'class' => 'alert alert-danger py-2 my-2', 'bag' => 'post_update'.$post->id])
    </div>
    <trigger click="postModalEditButton{{ $post->id }}" function="loadEditModalContent" function-args="{{ route('post.edit', ['id' => $post->id]) }}" />
@endif

<div class="post border p-3" style="position: relative;">
    <div class="post-header">
    <div class="post-avatar"><img src="{{ $user->photo }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div><a href="#" class="post-author link-body-underline font-weight-bold">{{ $user->fullName }} </a>
        <div class="post-header-info text-muted font-sm">{{ $post->timeSinceCreated }}</div>
        <div class="dropdown three-dots-dropdown dropleft">
            <a class="three-dots-button clickable-lgray" href="#" role="button" id="post{{ $post->id }}ThreeDotsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="post{{ $post->id }}ThreeDotsDropdown">
                @if ($user->id === Auth::user()->id)
                    <a class="dropdown-item" data-toggle="modal" id="postModalEditButton{{ $post->id }}" data-id="{{ $post->id }}" data-url="{{ route('post.edit', ['id' => $post->id]) }}" data-target="#editPostModal" href="#">Editar</a>
                    <button class="dropdown-item" data-confirm="Atenção||Deseja mesmo remover a postagem? Essa ação é irreversível!" data-url="{{ route('post.delete', [$post->id]) }}" data-class="text-danger">Remover</button>
                @endif
              </div>
        </div>
    </div><!--post-header-->

    <div class="clear"></div>

    <div class="post-content">
        <div class="post-description mt-2"> {{ $post->text }} </div>
        @if (isset($post->attachment))
        <div class="post-media mt-1 text-center"><img src="{{ $post->attachment }}" alt="" class="img-fluid"></div>
        @endif
    </div><!--post-content-->
    
    <div class="post-footer text-center mt-3 p-2 border-top border-bottom">
        <span class="post-likes clickable-lgray"><i class="far fa-thumbs-up fa-2x"></i> 100</span>
        {{-- <span class="mx-5"></span> --}}
        <a data-toggle="collapse" href="#collapsePost{{ $post->id }}" class="text-body">
            <span class="post-comments-info clickable-lgray"><i class="far fa-comment fa-2x"></i> 5</span>
        </a>
        <div class="collapse mt-4 text-left" id="collapsePost{{ $post->id }}">
            <div class="post-comment border-bottom pb-2">
                <div class="post-comment-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                <div class="post-comment-author font-weight-bold font-sm"> User FullName </div>
                <div class="post-comment-content font-sm">Comentário aleatório</div>
                <div class="clear"></div>
            </div><!--post-comment-->

            <div class="post-comment mt-2 border-bottom pb-2">
                <div class="post-comment-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                <div class="post-comment-author font-weight-bold font-sm"> User FullName </div>
                <div class="post-comment-content font-sm">Comentário aleatório</div>
                
                <div class="clear"></div>
            </div><!--post-comment-->

            <div class="post-comment mt-2">
                <div class="post-comment-avatar"><img src="{{ asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                <div class="post-comment-author font-weight-bold font-sm"> User FullName </div>
                <div class="post-comment-content font-sm">Comentário aleatório</div>
                <div class="clear"></div>
            </div><!--post-comment-->
        </div><!-- collapse -->
    </div><!--post-footer-->
</div><!--post-->