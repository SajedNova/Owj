<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class UpdateSiteSettingRequest extends FormRequest
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
            'address' => 'nullable|string|max:255',
            'address_en' => 'nullable|string|max:255',
            'phone' => 'nullable|string|max:50',
            'email' => 'nullable|email|max:255',
            'twitter_url' => 'nullable|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'telegram_url' => 'nullable|url|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'email.email' => 'فرمت ایمیل نامعتبر است.',
            'twitter_url.url' => 'فرمت لینک توییتر نامعتبر است.',
            'github_url.url' => 'فرمت لینک گیت‌هاب نامعتبر است.',
            'instagram_url.url' => 'فرمت لینک اینستاگرام نامعتبر است.',
            'telegram_url.url' => 'فرمت لینک تلگرام نامعتبر است.',
        ];
    }
}
