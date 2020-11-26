<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PersonInfoRequest extends FormRequest
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
            'firstname' => 'string|max:255',
            'lastname'  => 'string|max:255',
            'address'   => 'string|max:255',
            'passport'  => 'numeric|digits:11',
            'city'      => 'string|max:255|min:2',
            'number'    => 'numeric',
        ];
    }
}
