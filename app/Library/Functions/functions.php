<?php

use App\Helpers\ResponseHelper;
use App\Modules\Users\Repositories\UserRepository;
use App\Modules\Users\Resources\UserResource;
use Illuminate\Support\Facades\DB;


/**
 * Prints the data and status in to proper json structure
 *
 * @param \App\Models\User $user
 * @param string $message
 * @return \Illuminate\Http\JsonResponse
 */
function jsonresWithToken(\App\Models\User $user, $message = ResponseHelper::STATUS_MESSAGE_FOR_EMAIL_NOT_FOUND)
{
    if ($user->isEmptyEmail()) {
        return response()->json([
            'status' => false,
            'data' => [
                'email' => [
                    ResponseHelper::STATUS_MESSAGE_FOR_EMAIL_NOT_FOUND
                ]
            ],
            'message' => ResponseHelper::STATUS_MESSAGE_FOR_EMAIL_NOT_FOUND,
            'status_code' => ResponseHelper::STATUS_CODE_FOR_EMAIL_NOT_FOUND,
            'token' => auth('api')->login($user),
        ], ResponseHelper::STATUS_CODE_FOR_VALIDATION_ERROR);
    }

    if ($user->isEmptyVerified()) {

        try {
            DB::beginTransaction();

            $userRepository = app(UserRepository::class);

            $user = $userRepository->generateEmailVerificationCode($user);

            DB::commit();

            return response()->json([
                'status' => false,
                'data' => [
                    'email' => [
                        ResponseHelper::STATUS_MESSAGE_FOR_EMAIL_NOT_VERIFIED
                    ]
                ],
                'message' => ResponseHelper::STATUS_MESSAGE_FOR_EMAIL_NOT_VERIFIED,
                'status_code' => ResponseHelper::STATUS_CODE_FOR_EMAIL_NOT_VERIFIED,
                'token' => auth('api')->login($user),
            ], ResponseHelper::STATUS_CODE_FOR_VALIDATION_ERROR);

        } catch (\Exception $exception) {
            DB::rollback();


            if (app()->env == 'local') {
                dd($exception);
            } else {
                return jsonresServerError();
            }
        }
    }

    return response()->json([
        'status' => true,
        'data' => new UserResource($user),
        'message' => ResponseHelper::STATUS_MESSAGE_FOR_SUCCESS,
        'status_code' => ResponseHelper::STATUS_CODE_FOR_SUCCESS,
        'token' => auth('api')->login($user)
    ], ResponseHelper::STATUS_CODE_FOR_SUCCESS);
}

/**
 * @param $permissionName
 * @param null $user
 * @return bool
 */
function canPermission($permissionName, $user = null)
{
    if (empty($user)) {
        if (!auth()->check()) {
            return false;
        }
        $user = auth()->user();
    }

    return $user->hasPermissionTo($permissionName);
}


/**
 * @param $str
 * @param int $limit
 * @return string
 */
function limitString($str, $limit = 60)
{
    return strip_tags(substr($str, 0, $limit));
}

/**
 * Generates the alias equivalent for the provided string
 *
 * @param $string
 * @return mixed|string
 */
function generateAlias($string)
{
    $string = strtolower($string);
    $string = str_replace(" ", "-", $string);
    $string = str_replace(".", "-", $string);
    $string = str_replace("--", "-", $string);
    $string = str_replace("--", "-", $string);
    $string = str_replace("--", "-", $string);
    $string = str_replace("&", "and", $string);
    $string = str_replace("/", "-", $string);
    $string = str_replace("@", "", $string);
    $string = str_replace("(", "", $string);
    $string = str_replace(")", "", $string);
    $string = preg_replace('/[^a-zA-Z0-9_ %\[\]\.\(\)%&-]/s', '', $string);
    return $string;
}

/**
 * @param $hexCode
 * @return array
 */
function covertHexToRgb($hexCode){
    $hexCode = str_replace('#', '', $hexCode);
    $split = str_split($hexCode, 2);
    $r = hexdec($split[0]);
    $g = hexdec($split[1]);
    $b = hexdec($split[2]);

    return ['r' => $r, 'g' => $g, 'b' =>  $b];
}

/**
 * Increases or decreases the brightness of a color by a percentage of the current brightness.
 *
 * @param   string  $hexCode        Supported formats: `#FFF`, `#FFFFFF`, `FFF`, `FFFFFF`
 * @param   float   $adjustPercent  A number between -1 and 1. E.g. 0.3 = 30% lighter; -0.4 = 40% darker.
 *
 * @return  string
 *
 * @author  maliayas
 */
function adjustColourBrightness($hexCode, $adjustPercent = .05) {
    $hexCode = ltrim($hexCode, '#');

    if (strlen($hexCode) == 3) {
        $hexCode = $hexCode[0] . $hexCode[0] . $hexCode[1] . $hexCode[1] . $hexCode[2] . $hexCode[2];
    }

    $hexCode = array_map('hexdec', str_split($hexCode, 2));

    foreach ($hexCode as & $color) {
        $adjustableLimit = $adjustPercent < 0 ? $color : 255 - $color;
        $adjustAmount = ceil($adjustableLimit * $adjustPercent);

        $color = str_pad(dechex($color + $adjustAmount), 2, '0', STR_PAD_LEFT);
    }

    return '#' . implode($hexCode);
}

/**
 * Trim the array with non-empty values
 * @param $array
 * @return array
 */
function trimArray($array): array
{
    $trimmedArray = [];
    foreach($array as $key => $value){
        if(empty(trim($value))){
            continue;
        }
        $trimmedArray[$key] = $value;
    }
    return $trimmedArray;
}

/**
 * @param $number
 * @return string
 */
function getFormattedCurrencyNumber($number)
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
