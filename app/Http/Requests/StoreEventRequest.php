<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreEventRequest extends FormRequest
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
            'iTitle' => 'required|string|max:255',
            'iVenue' => 'required|string|max:124',
            'iDescription' => 'required|string',
            'iDatetime' => 'required',
            'ifImage' => 'nullable|mimes:jpeg,png|max:2048'
        ];
        return $rules;
    }
}
