<?php 
namespace App\Services;

use Exception;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Entities\User; #Model


class SomethingService {
    public function store(array $data){}

    public function update(int $id, array $data){}

    public function delete(int $id){}
}