<?php

use App\Helpers\ResponseHelper;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

/**
 * Returns the form control class for the input field based on the error available in the error object.
 *
 * @param $errors
 * @param $name String the input field name
 * @return string 'form-control' if no error was found or errors was null, else 'form-control form-control--error'
 */
function getFormControlClass($name, $errors = null)
{
    if ($errors == null) {
        return 'form-control';
    }
    return $errors->first($name) ? 'form-control is-invalid' : 'form-control';
}

/**
 * Outputs the input error message.
 *
 * @param $identifierName
 * @param null $errors
 * @return string
 */
function getFormInputErrorMessage($identifierName, $errors = null)
{
    return '<small class="form-text text-danger">' .
        $errors->first($identifierName, '<div class="text-danger">:message</div>') . '</small>';
}

/**
 * Prints the data and status in to proper json structure
 *
 * @param $data
 * @param bool $status
 * @param int $statusCode
 * @param string $message
 */
function jsonres($data, bool $status = false, $message = "", int $statusCode = 200)
{
    //strip any tokens
    if (is_array($data)) {
        if (array_key_exists('_token', $data)) {
            unset($data['_token']);
        }
    }

    return response()->json([
        'status' => $status,
        'data' => $data,
        'message' => $message,
        'status_code' => $statusCode
    ], $statusCode);
}

/**
 * Prints the data and status in to proper json structure
 *
 * @param $validationErrorData
 * @param bool $status
 * @param string $message
 * @param int $statusCode
 * @return \Illuminate\Http\JsonResponse
 */
function jsonresValidation($validationErrorData, $status = false, $message = ResponseHelper::STATUS_MESSAGE_FOR_VALIDATION_ERROR, $statusCode = ResponseHelper::STATUS_CODE_FOR_VALIDATION_ERROR)
{
    return jsonres(['errors' => $validationErrorData], $status, $message, $statusCode);
}

/**
 * @param array $successData
 * @param bool $status
 * @param string $message
 * @param int $statusCode
 * @return \Illuminate\Http\JsonResponse
 */
function jsonresSuccess($successData = [], $status = true, $message = ResponseHelper::STATUS_MESSAGE_FOR_SUCCESS, $statusCode = ResponseHelper::STATUS_CODE_FOR_SUCCESS)
{
    return jsonres($successData, $status, $message, $statusCode);
}

/**
 * @param array $errorData
 * @param bool $status
 * @param string $message
 * @param int $statusCode
 * @return \Illuminate\Http\JsonResponse
 */
function jsonresNotFound($errorData = [], $status = false, $message = ResponseHelper::STATUS_MESSAGE_FOR_NOT_FOUND, $statusCode = ResponseHelper::STATUS_CODE_FOR_NOT_FOUND)
{
    return jsonres($errorData, $status, $message, $statusCode);
}

/**
 * @param array $errorData
 * @param bool $status
 * @param string $message
 * @param int $statusCode
 * @return \Illuminate\Http\JsonResponse
 */
function jsonresServerError($errorData = [], $status = false, $message = ResponseHelper::STATUS_MESSAGE_FOR_INTERNAL_SERVER_ERROR, $statusCode = ResponseHelper::STATUS_CODE_FOR_INTERNAL_SERVER_ERROR)
{
    return jsonres($errorData, $status, $message, $statusCode);
}

/**
 * @param array $errorData
 * @param bool $status
 * @param string $message
 * @param int $statusCode
 * @return \Illuminate\Http\JsonResponse
 */
function jsonresUnauthorized($errorData = [], $status = false, $message = ResponseHelper::STATUS_MESSAGE_FOR_UNAUTHORIZED, $statusCode = ResponseHelper::STATUS_CODE_FOR_UNAUTHORIZED)
{
    return jsonres($errorData, $status, $message, $statusCode);
}

/**
 * @param $key
 * @param $array
 * @return mixed
 */
function arrayRemoveByKey($key, $array)
{
    if (!array_key_exists($key, $array)) {
        return $array;
    }
    unset($array[$key]);
    return $array;
}

/**
 * Extracts the value with the key from the array.
 *
 * @param $array
 * @param $key
 * @param string $default
 *
 * @return string|array
 */
function extractFromArray($array, $key, $default = '')
{

    if (is_array($array) && array_key_exists($key, $array)) {
        return $array[$key];
    } else {
        return $default;
    }
}

/**
 * @param null $imageUrl
 * @return string|null
 */
function getImageUrl($imageUrl = null)
{
    if (empty($imageUrl)) {
        return null;
    }

    return asset($imageUrl);
}

/**
 * @return string
 */
function getImageRandomName()
{
    return time() . uniqid();
}

/**
 * @param null $imageUrl
 * @return string
 */
function getImageUrlDefaultProfile($imageUrl = null)
{
    if (empty($imageUrl)) {
        $imageUrl = 'assets/images/default/potrait_placeholder.png';
    }

    return asset($imageUrl);
}

/**
 * @param null $imageUrl
 * @return string
 */
function getImageUrlDefaultAnimalProfile($imageUrl = null)
{
    if (empty($imageUrl)) {
        $imageUrl = 'assets/images/default/animal_placeholder.png';
    }

    return asset($imageUrl);
}

function resizeImage(\Intervention\Image\Image $image, $requiredSize)
{
    $width = $image->width();
    $height = $image->height();

    // Check if image resize is required or not
    if ($requiredSize >= $width && $requiredSize >= $height) return $image;

    $aspectRatio = $width / $height;
    if ($aspectRatio >= 1.0) {
        $newWidth = $requiredSize;
        $newHeight = $requiredSize / $aspectRatio;
    } else {
        $newWidth = $requiredSize * $aspectRatio;
        $newHeight = $requiredSize;
    }

    return $image->resize($newWidth, $newHeight);
}

/**
 * @param $imageUrl
 * @param null $folderName
 * @return string|null
 */
function uploadImageInSystem(\Intervention\Image\Image $image, $fileName = null)
{
    \Storage::disk('public')->put($fileName, $image->encode());

    return 'storage/' . $fileName;
}

function attachWatermarkImage(\Intervention\Image\Image $image, $waterMarkType = \App\Helpers\ImageHelper::WATERMARK_TYPE_FOR_NORMAL)
{
    return $image->insert(getWatermarkImage($waterMarkType));
}

function getWatermarkImage($watermarkType = \App\Helpers\ImageHelper::WATERMARK_TYPE_FOR_NORMAL)
{
    if ($watermarkType == \App\Helpers\ImageHelper::WATERMARK_TYPE_FOR_NORMAL) {
        $watermarkImageUrl = getWatermarkImageNormalUrl();
    } else {
        $watermarkImageUrl = getWatermarkImageThumbUrl();
    }
    return Image::make($watermarkImageUrl);
}

function getWatermarkImageThumbUrl()
{
    return 'images/' . \App\Helpers\ImageHelper::WATERMARK_PATH_FOR_THUMB_IMAGE;
}


function getWatermarkImageNormalUrl()
{
    return 'images/' . \App\Helpers\ImageHelper::WATERMARK_PATH_FOR_NORMAL_IMAGE;
}

/**
 * @param $folderName
 * @return string
 */
function getImageFileName($folderName): string
{
    $filename = getImageRandomName() . '.jpg';
    if (!empty($folderName)) {
        $filename = $folderName . '/' . $filename;
    }
    return $filename;
}

/**
 * @param $imageUrl
 * @return bool
 */
function deleteFileByUrl($imageUrl = null)
{
    if (empty($imageUrl)) {
        return true;
    }
    if (File::exists($imageUrl)) {
        return File::delete($imageUrl);
    }
    return true;
}

function isValidBase64($encodedImage)
{
    return preg_match('/^data:image\/(\w+);base64,/', $encodedImage);
}


/**
 * Sanitizes the input data.
 *
 * @param $input , may be a variable or array but not object.
 * @return string|array
 */
function sanitize($input)
{
    if (is_array($input)) {
        $returningArray = array();
        foreach ($input as $key => $value) {
            $returningArray[$key] = sanitize($value);
        }
        return $returningArray;
    } else {
        if (!is_numeric($input)) {
            return htmlspecialchars(trim($input));
        } else {
            return $input;
        }

    }
}

function generateVerificationCode()
{
    return random_int(10000, 99999);
}

/**
 * Gets the user in the session
 *
 * @return mixed
 */
function getSessionUser()
{
    global $__SESSION_USER;
    if (!$__SESSION_USER) {
        $__SESSION_USER = auth()->user();
    }
    return $__SESSION_USER;
}

/**
 * Gets the user id of the user in the session
 *
 * @return mixed
 */
function getSessionUserId()
{
    if (getSessionUser() == null) {
        return null;
    }
    return getSessionUser()->user_id;
}

/**
 * Gets the main role of the session user
 *
 * @return mixed
 */
function getSessionUserRole(){
    global $__SESSION_USER_ROLE;
    if(getSessionUser() == null){
        return null;
    }
    if(!$__SESSION_USER_ROLE){
        $__SESSION_USER_ROLE = getSessionUser()->mainRole();
    }
    return $__SESSION_USER_ROLE;
}

/**
 * Gets the main role name of the session user
 *
 * @return mixed
 */
function getSessionUserRoleName(){
    global $__SESSION_USER_ROLE_NAME;
    if(!empty(getSessionUserRole())){
        $__SESSION_USER_ROLE_NAME = getSessionUserRole()->name;
    }
    return $__SESSION_USER_ROLE_NAME;
}

function checkForPermission($permissionName)
{
    $__SESSION_USER = auth()->user();
    return $__SESSION_USER->isSuperAdministrator() || $__SESSION_USER->hasPermissionTo($permissionName);
}

function hasAnyNumber($string)
{
    if (preg_match("/[\p{N}]/u", $string)) {
        return true;
    }
    return false;
}

/**
 * Generate boolean lists
 * @return string[]
 */
function getBooleanLists()
{
    return [
        1 => 'Yes',
        0 => 'No',
    ];
}

/**
 * Calculate percentage
 * @param $numerator
 * @param $denominator
 * @param int $precision
 * @return float|int
 */
function calculatePercentage($numerator, $denominator, $precision = 2)
{
    return round(calculateDivide($numerator, $denominator, ($precision + 2)) * 100, $precision);
}

/**
 * @param $numerator
 * @param $denominator
 * @param int $precision
 * @return float|int
 */
function calculateDivide($numerator, $denominator, $precision = 2)
{
    if (empty($denominator)) {
        return 0;
    }

    return round($numerator / $denominator, $precision);
}

/**
 * Return color based on number
 * @param $number
 * @return string
 */
function bootstrapTextClass($number)
{
    if ($number > 0) {
        return 'text-success';
    } elseif ($number < 0) {
        return 'text-danger';
    } else {
        return 'text-gray-700';
    }
}

/**
 * Return color based on number
 * @param $number
 * @return string
 */
function bootstrapBgClass($number)
{
    if ($number > 0) {
        return 'bg-success text-white';
    } elseif ($number < 0) {
        return 'bg-danger text-white';
    } else {
        return 'bg-gray-700 text-white';
    }
}

/**
 * Return color based on number
 * @param $number
 * @return string
 */
function getChangeSign($number)
{
    if ($number > 0) {
        return '+';
    } elseif ($number < 0) {
        return '-';
    } else {
        return '';
    }
}

/**
 * Get Authenticated User
 */
function getAuthenticatedUser()
{
    global $___AUTH_USER;

    if (!$___AUTH_USER) {
        $___AUTH_USER = auth()->user();
    }
    return $___AUTH_USER;
}

/**
 * @return |null
 */
function getAuthenticatedUserId()
{
    if (empty(getAuthenticatedUser())) {
        return null;
    }
    return getAuthenticatedUser()->user_id;
}

/**
 * @return |null
 */
function getAuthenticatedRole()
{
    global $___AUTH_ROLE;

    if (empty(getAuthenticatedUser())) {
        return null;
    }

    if (!$___AUTH_ROLE) {
        $___AUTH_ROLE = getAuthenticatedUser()->mainRole();
    }

    return $___AUTH_ROLE;
}

/**
 * @return bool
 */
function isAuthenticatedSuperAdmin()
{
    if (empty(getAuthenticatedUser())) {
        return false;
    }

    return getAuthenticatedUser()->isSuperAdministrator();
}

function isAuthenticatedAdmin()
{
    if (empty(getAuthenticatedUser())) {
        return false;
    }

    if (empty(getAuthenticatedRole())) {
        return false;
    }

    return getAuthenticatedRole()->isAdmin();
}

function getReadableNumber($number)
{
    $isNumberNegative = $number < 0;
    $number = abs($number);
    $explrestunits = "";
    $numberArray = explode('.', $number, 2);
    $number = $numberArray[0];
    if (strlen($number) > 3) {
        $lastthree = substr($number, strlen($number) - 3, strlen($number));
        $restunits = substr($number, 0, strlen($number) - 3); // extracts the last three digits
        $restunits = (strlen($restunits) % 2 == 1) ? "0" . $restunits : $restunits; // explodes the remaining digits in 2's formats, adds a zero in the beginning to maintain the 2's grouping.
        $expunit = str_split($restunits, 2);
        for ($i = 0; $i < sizeof($expunit); $i++) {
            // creates each of the 2's group and adds a comma to the end
            if ($i == 0) {
                $explrestunits .= (int)$expunit[$i] . ","; // if is first value , convert into integer
            } else {
                $explrestunits .= $expunit[$i] . ",";
            }
        }
        $thecash = $explrestunits . $lastthree;
    } else {
        $thecash = $number;
    }
    return ($isNumberNegative ? '-' : '') . $thecash . (!empty($numberArray[1]) ? '.'. $numberArray[1] : ''); // writes the final format where $currency is the currency symbol.
}

function arrayToJson($array, $keyName = 'id', $valueName = 'name')
{
    $loop = 0;
    $bulkArray = [];
    foreach($array as $key => $value){
        $bulkArray[$loop][$keyName] = $key;
        $bulkArray[$loop][$valueName] = $value;
        $loop++;
    }
    return $bulkArray;
}

function defaultDateFormat()
{
    return config('constants.default_date_fromat');
}

function getNoUserImage()
{
    return asset('assets/images/no-photo-user.png');
}

function getNoFaviconImage()
{
    return asset('assets/images/favicon.ico');
}

function getLizeshImg()
{
    return asset('assets/images/lizeshakya.jpg');
}

/**
 * Check whether the authenticated user can update their password
 * @param $user
 * @param bool $isEdit
 * @return bool
 */
function canUpdatePassword($userId = null): bool
{
    return isAuthenticatedSuperAdmin() || empty($userId) || ($userId == getAuthenticatedUserId());
}
