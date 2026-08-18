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
        ];
    }

    // Helper to decode JSON skills before saving

}
