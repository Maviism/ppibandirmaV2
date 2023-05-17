<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBookRequest extends FormRequest
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
            'iTitle' => 'required|max:255',
            'iAuthor' => 'required|max:255',
            'iNumOfPages' => 'nullable|numeric',
            'iPublisher' => 'nullable',
            'iSynopsis' => 'nullable',
            'iCategory' => 'nullable',
            'ifImage' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        return $rules;
    }
}
