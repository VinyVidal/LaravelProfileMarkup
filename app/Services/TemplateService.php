<?php 
namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\User; #Model
use App\Exceptions\Response;

class SomethingService {
    public function store(array $data) {
        try {
            #
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function update(int $id, array $data) {
        try {
            #
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }

    public function delete(int $id) {
        try {
            #
        } catch (Exception $ex) {
            return Response::handle($ex);
        }
    }
}