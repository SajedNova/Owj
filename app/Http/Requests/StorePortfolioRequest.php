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
            'tools' => 'nullable|string'
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
            'is_published.boolean' => 'این فیلد باید بصورت بولین باشد'
        ];
    }
}
