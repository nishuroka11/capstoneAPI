<?php

namespace App\Http\Controllers\Test;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class TestController extends Controller
{
    public function index(Request $request)
    {
        if ($request->q == 'su') {
            $url = "https://uat.esewa.com.np/epay/transrec";
            $data = [
                'amt' => 100,
                'scd' => 'EPAYTEST',
                'pid' => '123456789147',
                'rid' => '0001WKA',
            ];

            $curl = curl_init($url);
            curl_setopt($curl, CURLOPT_POST, true);
            curl_setopt($curl, CURLOPT_POSTFIELDS, $data);
            curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
            $response = curl_exec($curl);
            curl_close($curl);
            dd($response);
        }
        dd('end');
    }

    public function success()
    {
        Log::info('Success hit');
    }

    public function failed()
    {
        Log::info('Failed');
    }
}
