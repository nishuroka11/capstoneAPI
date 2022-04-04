<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\View;

class BackendController extends Controller
{
    protected $additionalViewPrefix = "";

    /**
     * Returns the view from the ims folder in resources/views
     *
     * @param $view
     * @param array $data
     * @param array $mergeData
     * @return mixed
     */
    public function view($view, $data = array(), $mergeData = array())
    {
        if ($this->additionalViewPrefix != "") {
            $this->additionalViewPrefix .= ".";
        }
        return View::make('backend.' . $this->additionalViewPrefix . $view, $data, $mergeData);
    }
}


