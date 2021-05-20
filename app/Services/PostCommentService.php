<?php 
namespace App\Services;

use Exception;
use App\Entities\PostComment;
use App\Exceptions\Response;

class PostCommentService {
    public function store(array $data) {
        try {
            $comment = new PostComment();
            $comment->fill($data);
            $comment->save();

            return [
                'success' => true,
                'data' => $comment
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function update(int $id, array $data) {
        try {
            $comment = PostComment::find($id);
            $comment->fill($data);
            $comment->save();

            return [
                'success' => true,
                'data' => $comment
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function delete(int $id) {
        try {
            $comment = PostComment::find($id);
            $comment->delete();

            return [
                'success' => true
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function ajaxEdit(array $data)
    {
        try {
            $comment = PostComment::find($data['id'] ?? 0);
            if(!$comment) {
                throw new Exception('Comment not found');
            }

            $view = view('post.comment.edit-form', [
                'post' => $comment->post,
                'comment' => $comment
            ])->render();
            return [
                'success' => true,
                'data' => $view
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }
}