<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AuthRequest extends FormRequest
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
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'login' => ['required', 'string'],
            'password' => ['required', 'string', Password::min(8)->max(12)->mixedCase()->letters()->numbers()->symbols()],
        ];
    }
    public function messages(): array
    {
        return [
            'login.required' => 'وارد کردن نام کاربری یا ایمیل الزامی است.',
            'login.string' => 'فرمت نام کاربری یا ایمیل معتبر نیست.',
            'password.required' => 'وارد کردن کلمه عبور الزامی است.',
            'password.string' => 'فرمت کلمه عبور معتبر نیست.',
            'password.min' => 'کلمه عبور باید حداقل :min کاراکتر باشد.',
            'password.max' => 'کلمه عبور نباید بیشتر از :max کاراکتر باشد.',
            'password.mixed' => 'کلمه عبور باید شامل حروف بزرگ و کوچک باشد.',
            'password.letters' => 'کلمه عبور باید شامل حروف باشد.',
            'password.numbers' => 'کلمه عبور باید شامل حداقل یک عدد باشد.',
            'password.symbols' => 'کلمه عبور باید شامل حداقل یک نماد (کاراکتر خاص) باشد.',
            'password.uncompromised' => 'این کلمه عبور در نشت اطلاعات مشاهده شده است، لطفاً کلمه عبور دیگری انتخاب کنید.',
        ];
    }
}
