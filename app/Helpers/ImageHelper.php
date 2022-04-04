<?php

namespace App\Helpers;

class ImageHelper
{
    public const MAX_SIZE_FOR_THUMB = 500;
    public const MAX_SIZE_FOR_NORMAL = 1080;

    public const WATERMARK_PATH_FOR_THUMB_IMAGE = 'wml1_thumb.png';
    public const WATERMARK_PATH_FOR_NORMAL_IMAGE = 'wml1_normal.png';

    public const WATERMARK_TYPE_FOR_THUMB = 'thumb';
    public const WATERMARK_TYPE_FOR_NORMAL = 'normal';

    /**
     * @param $byteSize
     * @return int
     */
    public static function getQualityByFileSize($byteSize)
    {
        $mbSize = $byteSize / 1024 / 1024;
        if($mbSize < 1){
            $formattedSize = 40;
//        }elseif($mbSize < 2){
//            $formattedSize = 50;
//        }elseif($mbSize < 3){
//            $formattedSize = 30;
//        }elseif($mbSize < 8){
//            $formattedSize = 20;
        }else{
            $formattedSize = 10;
        }
        return $formattedSize;
    }

}
