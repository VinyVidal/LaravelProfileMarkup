<?php 
namespace App\Services;

use App\Entities\Chat;
use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\User; #Model
use App\Exceptions\Response;

class ChatService {
    public function store(array $data) {
        try {
            $chat = new Chat();
            $chat->fill($data);
            $chat->save();

            return [
                'success' => true,
                'data' => $chat
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function update(int $id, array $data) {
        try {
            $chat = Chat::find($id);
            $chat->message = $data['message'] ?? $chat->message;
            $chat->save();

            return [
                'success' => true,
                'data' => $chat
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function received(int $id) {
        try {
            $chat = Chat::find($id);
            $chat->received_at = date('Y-m-d H:i:s');
            $chat->save();

            return [
                'success' => true,
                'data' => $chat
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function seen(int $id) {
        try {
            $chat = Chat::find($id);
            $chat->seen_at = date('Y-m-d H:i:s');
            $chat->save();

            return [
                'success' => true,
                'data' => $chat
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function delete(int $id) {
        try {
            $chat = Chat::find($id);
            $chat->delete();

            return [
                'success' => true,
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }
}