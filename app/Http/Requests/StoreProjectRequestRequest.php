<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreProjectRequestRequest extends FormRequest
{
    /**
     * آیا کاربر اجازه‌ی ارسال این درخواست را دارد؟
     * فرم عمومی و برای همه باز است.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * قوانین اعتبارسنجی فیلدهای فرم.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        return [
            'name'    => ['required', 'string', 'min:2', 'max:100'],
            'email'   => ['required', 'string', 'email:rfc,dns', 'max:255'],
            'message' => ['required', 'string', 'min:10', 'max:5000'],
            // هانی‌پات ساده ضدِ اسپم؛ باید همیشه خالی بماند
            'website' => ['prohibited'],
        ];
    }

    /**
     * پیام‌های خطای سفارشی به فارسی.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required'    => 'وارد کردن نام الزامی است.',
            'name.min'         => 'نام باید حداقل ۲ کاراکتر باشد.',
            'email.required'   => 'وارد کردن ایمیل الزامی است.',
            'email.email'      => 'فرمت ایمیل معتبر نیست.',
            'message.required' => 'وارد کردن توضیحات پروژه الزامی است.',
            'message.min'      => 'توضیحات باید حداقل ۱۰ کاراکتر باشد.',
        ];
    }
}
