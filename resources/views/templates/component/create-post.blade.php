{{--
    Create post component and modal template
--}}

{{--                   PARAMETERS 
  * string   @name -> Name of the html element
    string   @value -> Field preset value
    string   @type -> Determine the type attribute of the element, possible values are 'text' or 'email'
    array    @attributes -> Array of html element | ['attribute' => 'value']
    string   @label -> Field label text, activates label for the field
    string   @sub -> Subtitle text for the field
    string   @subClass -> Subtitle text css class
    string   @class -> Html element class
    string   @useravatar -> User avatar photo
    
    *required
--}}
@if (count($errors) > 0)
    <trigger click="PostModalButton" />
@endif
{{-- Create Post Modal --}}
<div class="modal fade" id="newPostModal" tabindex="-1" role="dialog" aria-labelledby="newPostModal" aria-hidden="true">
    <div class="modal-dialog m-0 mx-md-auto my-md-4">
        <div class="modal-content">
        <div class="modal-header">
            <h3 class="modal-title">Nova publicação</h3>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
        
            {!! Form::open(['route' => 'post.store', 'method' => 'post', 'enctype' => 'multipart/form-data']) !!}

            @include('templates.form.select', ['name' => 'visibility', 'value' => [0 => 'Visível para todos', 1 => 'Somente eu']])
            @include('templates.form.textarea', ['name' => 'text', 'rows' => 6, 'attributes' => ['placeholder' => 'Escreva algo para a sua publicação...']])

            @include('templates.form.media-previewer', ['fileInputId' => 'postMedia', 'class' => 'img img-fluid'])

            <div class="post-attachments border py-1">
                @include('templates.form.file', ['name' => 'uploadedMedia', 'id' => 'postMedia', 'customButton' => ['class' => 'btn fas fa-photo-video text-success clickable-lgray', 'value' => ' Foto/Vídeo']])
            </div>

            @include('templates.form.hidden', ['name' => 'user_id', 'value' => $user->id ])
            
            @include('templates.form.errors', ['fields' => ['visibility', 'uploadedMedia', 'text', 'user_id'], 'class' => 'alert alert-danger py-2 my-2'])
            

        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
            @include('templates.form.submit', ['name' => 'Publicar', 'class' => 'btn-primary'])
            {!! Form::close() !!}
        </div>
        </div>
    </div>
</div>{{-- Create Post Modal --}}

<div class="container border rounded bg-dwhite mb-3">
    <div class="row py-2">
        <div class="col">
            <div class="input-group">
                <div class="input-group-prepend">
                   <img src="{{ $user->photo ?? asset('img/default-avatar.png') }}" alt="user-avatar" class="size-xs rounded-circle mr-3">
                </div>
                <span id="PostModalButton" data-toggle="modal" data-target="#newPostModal" class="form-control clickable-lgray mt-1">Crie uma nova publicação</span>
            </div>
        </div><!--col-->
    </div>
</div>