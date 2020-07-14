<?php
/**
 * Created by PhpStorm.
 * User: Tiaan Theunissen
 * Date: 2/7/2017
 * Time: 1:30 PM
 */

namespace App\Repository;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Mockery\Exception;


class UploadRepository
{
    /**
     * This functiuon expects the following.
     * $folder = The name of the folder you wish to create or check
     * $prop = The attribute on the model for the image, Example: avatar, thumbnail
     * $object = The actual object.
     * @param $folder
     * @param $prop
     * @param $object
     * @param null $size
     */
    public static function UploadOrReplace($folder, $prop, $object)
    {

        if (Input::file()) {
            $image = Input::file($prop);

            Storage::disk('local')->put('public/images/'.$folder.'-'.$image, $image, 'public');
       }
    }
}
