{{-- 
    Individual post component used for listing    
--}}

{{--                   PARAMETERS 
  * Model Post @post - The post model
    
    *required
--}}

@php
    $user = $post->user;
    $postErrors = 'post_update'.$post->id;
    $commentErrors = 'post_comment_update'.session('comment_id');
@endphp
@if (count($errors->$postErrors) > 0)
    <div class="d-none" id="errors">
        @include('templates.form.errors', ['fields' => ['visibility', 'uploadedMedia', 'text', 'user_id'], 'class' => 'alert alert-danger py-2 my-2', 'bag' => 'post_update'.$post->id])
    </div>
    <trigger click="postModalEditButton{{ $post->id }}" function="loadPostEditModalContent" function-args="{{ route('post.edit', ['id' => $post->id]) }}" />
@endif
@if (count($errors->$commentErrors) > 0 && $post->id == session('commented_post_id'))
    <div class="d-none" id="errors">
        @include('templates.form.errors', ['fields' => ['comment'], 'class' => 'alert alert-danger py-2 my-2', 'bag' => 'post_comment_update'.session('comment_id')])
    </div>
    <trigger click="commentModalEditButton{{ session('comment_id') }}" function="loadCommentEditModalContent" function-args="{{ route('post.comment.edit', [$post->id, session('comment_id')]) }}" />
@endif
@if (session('post_id') == $post->id)
    <span id="post{{ $post->id }}Scroll" scrollTo></span>
@endif

<div class="post border p-3" style="position: relative;">
    <div class="post-header">
    <div class="post-avatar"><img src="{{ $user->photo }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div><a href="{{route('user.profile', $user->username)}}" class="post-author link-body-underline font-weight-bold">{{ $user->fullName }} </a>
        <div class="post-header-info text-muted font-sm">
            {{ $post->timeSinceCreated }}
            @if ($user->id === Auth::user()->id)
                <p><i class="fas fa-eye"></i> {{ $post->visibilityText }}</p>
            @endif
        </div>
        @if ($user->id === Auth::user()->id)
            <div class="dropdown three-dots-dropdown dropleft">
                <a class="three-dots-button clickable-lgray" href="#" role="button" id="post{{ $post->id }}ThreeDotsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <i class="fas fa-ellipsis-v"></i>
                </a>
                <div class="dropdown-menu" aria-labelledby="post{{ $post->id }}ThreeDotsDropdown">
                    <a class="dropdown-item" data-toggle="modal" id="postModalEditButton{{ $post->id }}" data-id="{{ $post->id }}" data-url="{{ route('post.edit', ['id' => $post->id]) }}" data-target="#editPostModal" href="#">Editar</a>
                    <button class="dropdown-item" data-confirm="Atenção||Deseja mesmo remover a postagem? Essa ação é irreversível!" data-url="{{ route('post.delete', [$post->id]) }}" data-class="text-danger">Remover</button>
                </div>
            </div>
        @endif
    </div><!--post-header-->

    <div class="clear"></div>

    <div class="post-content">
        <div class="post-description mt-2"> {{ $post->text }} </div>
        @if (isset($post->attachment))
        <div class="post-media mt-1 text-center"><img src="{{ $post->attachment }}" alt="" class="img-fluid"></div>
        @endif
    </div><!--post-content-->
    
    <div class="post-footer text-center mt-3 p-2 border-top border-bottom">
        @if (Auth::user()->likedPost($post))
            <span class="post-likes clickable-lgray" title="Descurtir" onclick="window.location.href='{{ route('post.unlike', [$post->id, 'user_id' => Auth::user()->id]) }}'"><i class="fas fa-thumbs-up fa-2x"></i> {{ $post->likes->count() }}</span>
        @else
            <span class="post-likes clickable-lgray" title="Curtir" onclick="window.location.href='{{ route('post.like', [$post->id, 'user_id' => Auth::user()->id]) }}'"><i class="far fa-thumbs-up fa-2x"></i> {{ $post->likes->count() }}</span>
        @endif
        {{-- <span class="mx-5"></span> --}}
        <a data-toggle="collapse" href="#collapsePost{{ $post->id }}" class="text-body">
            <span class="post-comments-info clickable-lgray"><i class="far fa-comment fa-2x"></i> {{ $post->comments->count() }}</span>
        </a>
        @if (session('commented_post_id') && session('commented_post_id') == $post->id)
                <span id="post{{ $post->id }}CommentErrors" scrollTo></span>
        @endif
        <div class="collapse {{ (session('comment') && session('comment')->post_id == $post->id) || session('commented_post_id') ? 'show' : '' }} mt-4 text-left" id="collapsePost{{ $post->id }}">
            @if ($post->comments->count())
            @foreach ($post->comments->all() as $comment)
                <div id="comment{{ $comment->id }}Wrapper" style="position: relative;" class="post-comment border-bottom pb-2 mt-2" {{ session('comment') && session('comment')->id == $comment->id ? 'scrollTo' : '' }}>
                    @if($comment->user->id == Auth::user()->id)
                        <div class="dropdown three-dots-dropdown dropleft">
                            <a class="three-dots-button clickable-lgray" href="#" role="button" id="comment{{ $comment->id }}ThreeDotsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-ellipsis-v"></i>
                            </a>
                            <div class="dropdown-menu" aria-labelledby="comment{{ $comment->id }}ThreeDotsDropdown">
                                <a class="dropdown-item" data-toggle="modal" id="commentModalEditButton{{ $comment->id }}" data-id="{{ $comment->id }}" data-url="{{ route('post.comment.edit', [$post->id, $comment->id]) }}" data-target="#editCommentModal" href="#">Editar</a>
                                <button class="dropdown-item" data-confirm="Atenção||Deseja mesmo remover o comentário? Essa ação é irreversível!" data-url="{{ route('post.comment.delete', [$post->id, $comment->id]) }}" data-class="text-danger">Remover</button>
                            </div>
                        </div>
                    @endif
                    <div class="post-comment-avatar"><img src="{{ asset($comment->user->photo) }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div>
                    <div class="post-comment-author font-weight-bold font-sm"> <a href="{{route('user.profile', $comment->user->username)}}" class="link-body-underline font-weight-bold">{{ $comment->user->fullName }} </a> </div>
                    <div class="post-comment-content">{{ $comment->comment }}</div>
                    <div class="font-sm text-muted">{{ $comment->timeSinceCreated }}</div>
                    <div class="clear"></div>
                </div><!--post-comment-->  
            @endforeach
            @else
                <p class="px-3">Seja o primeiro a comentar!</p>
            @endif
            
            
            {!! Form::open(['method' => 'post', 'route' => ['post.comment.store', $post->id]]) !!}
            <div class="row mt-3">
                <div class="col">
                    <div class="input-group">
                        <div class="input-group-prepend">
                        <img src="{{ Auth::user()->photo ?? asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3">
                        </div>
                        <input class="form-control mt-1" placeholder="Deixe um comentário" name="comment" required="required">
                        <button type="submit" class="form-control col-2 mt-1 btn btn-primary"> Enviar</button>
                    </div>
                </div><!--col-->
            </div>
            @if (session('commented_post_id') && session('commented_post_id') == $post->id)
                <span id="post{{ $post->id }}CommentErrors" scrollTo></span>
                @include('templates.form.errors', ['fields' => ['comment'], 'class' => 'alert alert-danger py-2 my-2', 'bag' => 'post_comment_create'])
            @endif
            {!! Form::close() !!}
        </div><!-- collapse -->
    </div><!--post-footer-->
</div><!--post-->
@include('post.comment.edit')