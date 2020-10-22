<?php 
namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\Post;


class PostService {

    public function store(array $data)
    {
        $post = new Post;
        $post->fill($data);

        if(isset($data['uploadedMedia']))
        {
            //Storage::disk('public')->delete( str_replace('/storage/', '', $user->photo) );
            $post->attachment = Storage::url(Storage::disk('public')->putFile('users/'.Auth::user()->username, $data['uploadedMedia']));
        }

        $post->save();

        return [
            'success' => true,
            'data' => $post
        ];   
    }

    public function update(int $id, array $data)
    {
        $post = Post::find($id);
        $post->fill($data);

        dd($data['uploadedMedia']);
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
    }

    public function delete(int $id)
    {
        Post::find($id)->delete();

        return [
            'success' => true
        ];
    }
}