{!! Form::model($post, ['route' => ['post.update', $post->id], 'method' => 'post', 'enctype' => 'multipart/form-data', 'name' => 'post-update-form', 'id' => 'post-update-form']) !!}

@include('templates.form.select', ['name' => 'visibility', 'value' => [0 => 'Visível para todos', 1 => 'Somente eu']])
@include('templates.form.textarea', ['name' => 'text', 'rows' => 6, 'attributes' => ['placeholder' => 'Escreva algo para a sua publicação...']])

@include('templates.form.media-previewer', ['fileInputId' => 'editPost'.$post->id.'Media', 'defaultValue' => $post->attachment, 'class' => 'img img-fluid'])

<div class="post-attachments border py-1">
    @include('templates.form.file', ['name' => 'uploadedMedia', 'id' => 'editPost'.$post->id.'Media', 'customButton' => ['class' => 'btn fas fa-photo-video text-success clickable-lgray', 'value' => ' Foto/Vídeo']])
</div>

<div id="editPostModalErrors"></div>