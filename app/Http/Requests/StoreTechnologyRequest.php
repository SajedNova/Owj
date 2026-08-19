<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreTechnologyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'icon' => 'required|string|max:50',
            'name' => 'required|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'icon.required' => 'آیکون یا تصویر الزامی است.',
            'name.required' => 'نام تکنولوژی الزامی است.',
        ];
    }
}
