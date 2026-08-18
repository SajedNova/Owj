<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreTeamMemberRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'slug' => 'required|string|unique:team_members,slug',
            'avatar' => 'nullable|image|max:2048',
            'role' => 'required|string',
            'bio' => 'nullable|string',
            'skills' => 'required|string', // JSON comes as string from form
            'experience' => 'nullable|string',
            'name_en' => 'nullable|string|max:255',
            'slug_en' => 'nullable|string|unique:team_members,slug_en',
            'role_en' => 'nullable|string|max:255',
            'experience_en' => 'nullable|string|max:255',
            'bio_en' => 'nullable|string',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'نام و نام‌خانوادگی الزامی است.',
            'slug.required' => 'نامک آدرس الزامی است.',
            'role.required' => 'نقش الزامی است.',
            'slug.unique' => 'این نامک قبلاً استفاده شده است.',
            'avatar.image' => 'فایل انتخابی باید یک تصویر باشد.',
            'avatar.max' => 'حجم تصویر نباید بیشتر از ۲ مگابایت باشد.',
            'slug_en.unique' => 'این نامک انگلیسی قبلاً استفاده شده است.',
            'name_en.max' => 'نام انگلیسی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'role_en.max' => 'نقش انگلیسی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'experience_en.max' => 'سابقه کاری انگلیسی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
        ];
    }

    // Helper to decode JSON skills before saving

}
