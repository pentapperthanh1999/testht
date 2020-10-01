<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class fileUploadRequest extends FormRequest
{
    public function authorize()
    {
        return true;
    }

    public function rules()
    {
        return [
            'file' => 'required|mimes:jpeg,png,jpg,gif, svg,csv,txt,xlx,xls,pdf|max:2048'
        ];
    }
}
