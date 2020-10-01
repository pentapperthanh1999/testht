<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PostRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'title' => 'required|string|min:2|max:100',
            'desc' => 'required|string|max:255',
            'user_id' => 'required|exists:users,id',
        ];
    }
}
