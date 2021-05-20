{!! Form::model($comment, ['route' => ['post.comment.update', [$post->id, $comment->id]], 'method' => 'post', 'enctype' => 'multipart/form-data', 'name' => 'post-comment-update-form', 'id' => 'post-comment-update-form']) !!}

@include('templates.form.input', ['name' => 'comment', 'attributes' => ['placeholder' => 'Comentário']])

<div id="editCommentModalErrors"></div>