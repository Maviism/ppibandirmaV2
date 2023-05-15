<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreKabinetRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $rules = [
            'iName' => 'required|string|max:255',
            'iPeriode' => 'required',
            'iDescription' => 'nullable|string',
            'ifLogoImage' => 'nullable|image|max:5000',
            'position.*.member.*.profile_pict' => 'nullable|image'
        ];
        return $rules;
    }
}
