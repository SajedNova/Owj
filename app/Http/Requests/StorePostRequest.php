<?php

namespace App\Http\Requests;

use App\Models\Post;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'title'   => ['required', 'string', 'max:255'],
            'category'=> ['nullable', 'string', 'max:100'],
            'excerpt' => ['nullable', 'string', 'max:500'],
            'content' => ['required', 'string'],
            'image'   => ['nullable', 'image', 'mimes:jpg,jpeg,png,webp', 'max:2048'],
            'status'  => ['required', Rule::in([Post::STATUS_DRAFT, Post::STATUS_PUBLISHED])],
        ];
    }

    public function messages(): array
    {
        return [
            'title.required'   => 'وارد کردن عنوان الزامی است.',
            'content.required' => 'وارد کردن متن پست الزامی است.',
            'image.image'      => 'فایل انتخاب‌شده باید یک تصویر باشد.',
            'image.mimes'      => 'فرمت تصویر باید jpg، jpeg، png یا webp باشد.',
            'image.max'        => 'حجم تصویر نباید بیشتر از 2 مگابایت باشد.',
            'status.required'  => 'وضعیت پست را انتخاب کنید.',
        ];
    }
}
