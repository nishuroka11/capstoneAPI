<?php

namespace App\Modules\PagePosts\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class PagePostCreateRequest extends FormRequest
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
     * @return array
     */
    public function rules(Request $request)
    {
        return [
            'page_post_name' => 'required',
            'page_post_slug' => 'required|unique:page_posts,page_post_slug',
            'page_post_description' => 'required'
        ];
    }
}
