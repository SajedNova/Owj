<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class StoreAchievementRequest extends FormRequest
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
            'icon' => 'required|string|max:10',
            'title' => 'required|string|max:255',
            'title_en' => 'nullable|string|max:255',
            'description' => 'required|string|max:500',
            'description_en' => 'nullable|string|max:500',
        ];
    }

    public function messages(): array
    {
        return [
            'icon.required' => 'آیکون الزامی است.',
            'title.required' => 'عنوان فارسی الزامی است.',
            'description.required' => 'توضیحات فارسی الزامی است.',
        ];
    }
}
