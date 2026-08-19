<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'max:100'],
            'email'   => ['required', 'email', 'max:150'],
            'message' => ['required', 'string', 'max:2000'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'    => 'وارد کردن نام الزامی است.',
            'email.required'   => 'وارد کردن ایمیل الزامی است.',
            'email.email'      => 'فرمت ایمیل صحیح نیست.',
            'message.required' => 'وارد کردن پیام الزامی است.',
        ];
    }
}
