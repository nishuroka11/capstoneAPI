<?php

namespace App\Modules\PagePosts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PagePostUpdateRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @param Request $request
     * @return array
     */
    public function rules()
    {
        return [
            'page_post_name' => 'required',
            'page_post_slug' => 'required',
            'page_post_description' => 'required'
        ];
    }
}
