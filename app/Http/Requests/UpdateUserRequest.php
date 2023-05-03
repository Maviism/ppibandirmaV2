<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'iFullname' => 'required|max:255|string',
            'iMail' => 'required|unique:users,email'.$this->user->id,
            'iPhone' => 'required|integer|min_digits:6|max_digits:16',
            'iAddress' => 'nullable',
            'iBirthday' => 'required',
            'iArrivalYear' => 'required',
            'iFaculty' => 'required',
            'iDepartment' => 'required'
        ];
    }
}
