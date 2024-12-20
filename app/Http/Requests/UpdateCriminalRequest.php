<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCriminalRequest extends FormRequest
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
    public function rules()
    {
        return [
            'name' => 'required|string|max:150',
            'photo' => 'nullable',
            'mobile' => 'nullable',
            'age' => 'required|integer',
            'gender' => 'required|string|max:20',
            'remarks' => 'required|string|max:250',
        ];
    }
}
