<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreBrandRequest extends FormRequest
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
            'name' => 'required|string|max:255',
            'logo' => ['required', 'file', function($attribute, $value, $fail) {
                if ($value->getClientOriginalExtension() !== 'svg') {
                    $fail('فقط فایل SVG مجاز است.');
                }
            }],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام برند الزامی است.',
            'logo.required' => 'فایل لوگو (SVG) الزامی است.',
        ];
    }
}
