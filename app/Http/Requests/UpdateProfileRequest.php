<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule as ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateProfileRequest extends FormRequest
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
        $id=auth()->user()->id;
        return [
            'name'=>'required',
            'email'=>'required|unique:users,email,'.$id,

            
            // 'email'=>['required','email',Rule::unique('users')->ignore(auth()->user()->id,'id')]
        ];
    }
}
