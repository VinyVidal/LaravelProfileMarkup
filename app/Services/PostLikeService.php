<?php 
namespace App\Services;

use Exception;
use App\Entities\PostLike;
use App\Entities\UserActivity;
use App\Exceptions\Response;

class PostLikeService {
    public function store(array $data) {
        try {
            if(PostLike::where('post_id', $data['post_id'])->where('user_id', $data['user_id'])->exists()) {
                throw new Exception('Você já curtiu a publicação');
            }

            $like = new PostLike;
            $like->fill($data);
            $like->save();

            // Register activity
            $activityService = new UserActivityService;
            $activityService->store([
                'user_id' => $like->user_id,
                'model' => PostLike::class,
                'model_id' => $like->id
            ]);

            return [
                'success' => true,
                'data' => $like
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function delete($data) {
        try {
            $like = PostLike::where('user_id', $data['user_id'])
                ->where('post_id', $data['post_id'])->first();
            $like->delete();

            //Delete activity
            UserActivity::where('model', PostLike::class)->where('model_id', $like->id)->delete();

            return [
                'success' => true,
                'data' => $data['post_id']
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }
}