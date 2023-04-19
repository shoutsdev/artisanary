<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class BlogRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }
    public function rules(): array
    {
        $rules = [
            'title'         => 'required|string|max:255|unique:blogs,title,'.$this->id,
            'description'   => 'required'
        ];

        if($this->method() == 'POST') {
            $rules['image'] = 'required';
        }
        return $rules;
    }

    public function messages(): array
    {
        return [
            'title.required'        => 'Title is required',
            'title.max'             => 'Title must be less than 255 characters',
        ];
    }
}
