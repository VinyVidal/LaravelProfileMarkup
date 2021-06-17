<?php 
namespace App\Services;

use Exception;
use App\Entities\UserActivity;
use App\Exceptions\Response;

class UserActivityService {
    public function store(array $data) {
        try {
            $activity = new UserActivity;
            $activity->fill($data);
            $activity->save();

            return [
                'success' => true,
                'msg' => 'Atividade registrada com sucesso',
                'data' => $activity
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function update(int $id, array $data) {
        try {
            $activity = UserActivity::find($id);
            $activity->fill($data);
            $activity->save();

            return [
                'success' => true,
                'msg' => 'Atividade atualizada com sucesso',
                'data' => $activity
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function delete(int $id) {
        try {
            UserActivity::find($id)->delete();

            return [
                'success' => true,
                'msg' => 'Atividade excluída com sucesso'
            ];
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }
}