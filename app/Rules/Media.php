<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class Media implements Rule
{
    private $acceptedImgFormats = ['png', 'jpg', 'jpeg', 'gif', 'bmp'];
    private $acceptedVideoFormats = ['mp4', 'avi', 'mkv'];
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        $type = explode('/', $value->getMimeType())[1];
        if(in_array($type, $this->acceptedImgFormats)) {
            return true;
        }

        if(in_array($type, $this->acceptedVideoFormats)) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Field value must be a valid img or video file!';
    }
}
