<?php 
namespace App\Services;

use Exception;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\Post;
use App\Entities\UserActivity;
use App\Exceptions\Response;

class PostService {

    public function store(array $data)
    {
        try {
            $post = new Post;
            $post->fill($data);

            if(isset($data['uploadedMedia']))
            {
                //Storage::disk('public')->delete( str_replace('/storage/', '', $user->photo) );
                $post->attachment = Storage::url(Storage::disk('public')->putFile('users/'.Auth::user()->username, $data['uploadedMedia']));
            }

            $post->save();

            // Register activity
            $activityService = new UserActivityService;
            $activityService->store([
                'user_id' => $post->user_id,
                'model' => Post::class,
                'model_id' => $post->id
            ]);

            return [
                'success' => true,
                'data' => $post
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        } 
    }

    public function update(int $id, array $data)
    {
        try {
            $post = Post::find($id);
            $post->fill($data);

            if(isset($data['uploadedMedia']))
            {
                Storage::disk('public')->delete( str_replace('/storage/', '', $post->attachment) );
                $post->attachment = Storage::url(Storage::disk('public')->putFile('users/'.Auth::user()->username, $data['uploadedMedia']));
            }

            $post->save();

            return [
                'success' => true,
                'data' => $post
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        } 
    }

    public function delete(int $id)
    {
        try {
            $post = Post::find($id);
            $post->delete();

            //Delete activity
            UserActivity::where('model', Post::class)->where('model_id', $post->id)->delete();

            //Delete Related comments
            foreach($post->comments->all() as $comment) {
                $commentService = new PostCommentService;
                $commentService->delete($comment->id);
            }
            //Delete Related likes
            foreach($post->likes->all() as $like) {
                $likeService = new PostLikeService;
                $likeService->delete(['user_id' => $like->user_id, 'post_id' => $like->post_id]);
            }

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
            $post = Post::find($data['id'] ?? 0);
            if(!$post) {
                throw new Exception('Post not found');
            }

            $view = view('post.edit-form', [
                'post' => $post
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