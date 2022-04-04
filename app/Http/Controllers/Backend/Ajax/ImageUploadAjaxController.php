<?php

namespace App\Http\Controllers\Backend\Ajax;

use App\Helpers\ImageHelper;
use App\Helpers\ResponseHelper;
use App\Http\Controllers\BackendController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ImageUploadAjaxController extends BackendController
{
    public function imageUpload(Request $request)
    {
        try {
            $previousImageUrl = extractFromArray($request->all(), 'previousImageUrl', null);

            //Delete previous image
            if (!empty($previousImageUrl)) {
                if (\File::exists($previousImageUrl)) {
                    \File::delete($previousImageUrl);
                }
            }



            $folderName = extractFromArray($request->all(), 'folderName', 'images');
            if ($request->hasFile('fileImage')) {
                $file = $request->file('fileImage');
                $allowedMimeTypes = ['image/jpeg','image/gif','image/png','image/bmp','image/svg+xml', 'image/x-icon'];
                $contentType = $file->getClientMimeType();

                if(! in_array($contentType, $allowedMimeTypes) ){
                    return response()->json([
                        'status' => false,
                        'message' => 'File is not of type image',
                        'status_code' => ResponseHelper::STATUS_CODE_FOR_VALIDATION_ERROR
                    ], ResponseHelper::STATUS_CODE_FOR_SUCCESS);
                }

                $folderName = (isset($folderName) ? $folderName . '/' : '');
                $fileName = getImageRandomName() . '.' .$file->extension();
                $resizedImage = Image::make($file);
                $resizedImage = $resizedImage
                    ->encode(null, ImageHelper::getQualityByFileSize($file->getSize()));
                Storage::disk('public')->put($folderName . $fileName, $resizedImage->__toString());

                return response()->json([
                    'status' => true,
                    'data' => [
                        'imagePath' => 'storage/' . $folderName . $fileName,
                        'assetImagePath' => asset('storage/' . $folderName . $fileName)
                    ],
                    'message' => 'Image uploaded',
                    'status_code' => ResponseHelper::STATUS_CODE_FOR_SUCCESS
                ], ResponseHelper::STATUS_CODE_FOR_SUCCESS);
            }
        } catch (\Exception $exception) {
            if (app()->env == 'local') {
                dd($exception);
            } else {

                return response()->json([
                    'status' => false,
                    'message' => ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR,
                    'status_code' => ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR
                ], ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR);
            }
        }
    }
}
