<?php

namespace App\Exceptions;

class Response {

    /**
     * @param mixed $exception
     */
    public static function handle($exception) {
        switch (get_class($exception)) {
            case QueryException::class      : return ['success' => false, 'message' => $exception->getMessage()];
            case ValidatorException::class  : return ['success' => false, 'message' => $exception->getMessageBag()];
            case Exception::class           : return ['success' => false, 'message' => $exception->getMessage()];
            default                         : return ['success' => false, 'message' => $exception->getMessage()];
        }
    }
}