<?php

namespace Modules\News\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class NewsPostRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'title' => 'required|unique:news|max:255',
            'description' => 'required',
            'is_published' => 'required'
        ];
    }


    public function messages()
    {
        return [
            'title.required' => 'title is required!',
            'description.required' => 'description is required!',
            'is_published.required' => 'is_published is required!'
        ];
    }
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }


}
