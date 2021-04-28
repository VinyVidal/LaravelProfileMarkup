{{-- 
    Edit post modal    
--}}

{{--                   PARAMETERS 
  * Model Post @post - The post model
    
    *required
--}}
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
        
            {!! Form::model($post, ['route' => ['post.update', $post->id], 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

            @include('templates.form.select', ['name' => 'visibility', 'value' => [0 => 'Visível para todos', 1 => 'Somente eu']])
            @include('templates.form.textarea', ['name' => 'text', 'rows' => 6, 'attributes' => ['placeholder' => 'Escreva algo para a sua publicação...']])

            @include('templates.form.media-previewer', ['fileInputId' => 'post'.$post->id.'Media', 'defaultValue' => $post->attachment, 'class' => 'img img-fluid'])

            <div class="post-attachments border py-1">
                @include('templates.form.file', ['name' => 'uploadedMedia', 'id' => 'post'.$post->id.'Media', 'customButton' => ['class' => 'btn fas fa-photo-video text-success clickable-lgray', 'value' => ' Foto/Vídeo']])
            </div>
            
            @include('templates.form.errors', ['fields' => ['visibility', 'uploadedMedia', 'text', 'user_id'], 'class' => 'alert alert-danger py-2 my-2', 'bag' => 'post_update'])
            

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            @include('templates.form.submit', ['name' => 'Salvar', 'class' => 'btn-primary'])
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>