<?php 
namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\UserFollow;
use App\Exceptions\Response;

class UserFollowService {
    public function follow(array $data) {
        try {
            if(!UserFollow::where('follower_id', $data['follower_id'])->where('followed_id', $data['followed_id'])->exists()) {
                $userFollow = new UserFollow;
                $userFollow->fill($data);
                $userFollow->save();
            }
            return [
                'success' => true,
                'data' => $userFollow
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function unfollow(array $data) {
        try {
            $userFollow = UserFollow::where('follower_id', $data['follower_id'])->where('followed_id', $data['followed_id'])->first();
            if($userFollow) {
                $userFollow->delete();
            }
            return [
                'success' => true,
                'data' => $userFollow
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }
}