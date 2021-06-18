<?php

namespace App\Constants;

class PostVisibilityConstant
{
    const VISIBLE_PUBLIC = 0;
    const FOLLOWERS_ONLY = 1;
    const SELF_ONLY = 2;

    public static $options = [
        self::VISIBLE_PUBLIC => 'Visível para o publico',
        self::FOLLOWERS_ONLY => 'Apenas seguidores',
        self::SELF_ONLY => 'Apenas eu',
    ];

    public static function getOptions(){
        return self::$options;
    }

    public static function getOption($key){
        if(!isset(self::$options[$key])){
            return null;
        }

        return self::$options[$key];
    }
}
