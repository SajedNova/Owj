<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePortfolioRequest extends FormRequest
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
            'title' => 'required|string|max:255',
            'slug' => ['required', 'string', Rule::unique('portfolios', 'slug')->ignore($this->route('portfolio'))],
            'short_description' => 'required|string|max:255',
            'description' => 'required|string',
            'client_name' => 'nullable|string|max:255',
            'project_url' => 'nullable|url',
            'duration' => 'nullable|string|max:255',
            'category' => 'required|in:website,application',
            'is_published' => 'boolean',
            'tools' => 'nullable|string',
            'title_en' => 'nullable|string|max:255',
            'slug_en' => ['nullable', 'string', Rule::unique('portfolios', 'slug_en')->ignore($this->route('portfolio'))],
            'short_description_en' => 'nullable|string|max:255',
            'description_en' => 'nullable|string',
            'client_name_en' => 'nullable|string|max:255',
            'duration_en' => 'nullable|string|max:255',
        ];
    }

    public function messages(): array
    {
        return [
            'title.required' => 'عنوان الزامی است.',
            'slug.required' => 'نامک الزامی است.',
            'slug.unique' => 'این نامک قبلاً استفاده شده است.',
            'short_description.required' => 'توضیحات کوتاه الزامی است.',
            'description.required' => 'توضیحات پروژه الزامی است.',
            'category.required' => 'دسته‌بندی الزامی است.',
            'category.in' => 'دسته‌بندی انتخاب شده معتبر نیست.',
            'is_published.boolean' => 'این فیلد باید بصورت بولین باشد',
            'title_en.max' => 'عنوان انگلیسی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'slug_en.unique' => 'این نامک انگلیسی قبلاً استفاده شده است.',
            'short_description_en.max' => 'توضیحات کوتاه انگلیسی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'client_name_en.max' => 'نام کارفرمای انگلیسی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
            'duration_en.max' => 'مدت زمان انگلیسی نباید بیشتر از ۲۵۵ کاراکتر باشد.',
        ];
    }
}
