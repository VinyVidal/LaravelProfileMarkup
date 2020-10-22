{{-- 
    Individual post component used for listing    
--}}

{{--                   PARAMETERS 
  * Model Post @post - The post model
    
    *required
--}}

@php
    $user = $post->user;
@endphp

<div class="post border p-3" style="position: relative;">
    <div class="post-header">
    <div class="post-avatar"><img src="{{ $user->photo }}" alt="user-avatar" class="size-xs rounded-circle mr-3 float-left"></div><a href="#" class="post-author link-body-underline font-weight-bold">{{ $user->fullName }} </a>
        <div class="post-header-info text-muted font-sm">{{ $post->timeSinceCreated }}</div>
        <div class="dropdown three-dots-dropdown dropleft">
            <a class="three-dots-button clickable-lgray" href="#" role="button" id="post{{ $post->id }}ThreeDotsDropdown" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-ellipsis-v"></i>
            </a>
            <div class="dropdown-menu" aria-labelledby="post{{ $post->id }}ThreeDotsDropdown">
                <a class="dropdown-item" data-toggle="modal" data-target="#editPostb{{ $post->id }}Modal" href="#">Editar Publicação</a>
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

{{-- Edit Post Modal --}}
<div class="modal fade" id="editPostb{{ $post->id }}Modal" tabindex="-1" role="dialog" aria-labelledby="editPostb{{ $post->id }}Modal" aria-hidden="true">
    <div class="modal-dialog m-0 mx-md-auto my-md-4">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Editar publicação</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        
            {!! Form::model($post, ['route' => 'post.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

            @include('templates.form.select', ['name' => 'visibility', 'value' => [0 => 'Visível para todos', 1 => 'Somente eu']])
            @include('templates.form.textarea', ['name' => 'text', 'rows' => 6, 'attributes' => ['placeholder' => 'Escreva algo para a sua publicação...']])

            @include('templates.form.media-previewer', ['fileInputId' => 'postMedia', 'class' => 'img img-fluid'])

            <div class="post-attachments border py-1">
                @include('templates.form.file', ['name' => 'uploadedMedia', 'id' => 'postMedia', 'customButton' => ['class' => 'btn fas fa-photo-video text-success clickable-lgray', 'value' => ' Foto/Vídeo']])
            </div>
            
            @include('templates.form.errors', ['fields' => ['visibility', 'uploadedMedia', 'text', 'user_id'], 'class' => 'alert alert-danger py-2 my-2'])
            

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            @include('templates.form.submit', ['name' => 'Publicar', 'class' => 'btn-primary'])
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>{{-- Edit Post Modal --}}