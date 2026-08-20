<?php

namespace App\Ai\Agents;

use Illuminate\Contracts\JsonSchema\JsonSchema;
use Laravel\Ai\Attributes\MaxTokens;
use Laravel\Ai\Attributes\Model;
use Laravel\Ai\Attributes\Provider;
use Laravel\Ai\Attributes\Temperature;
use Laravel\Ai\Contracts\Agent;
use Laravel\Ai\Contracts\HasStructuredOutput;
use Laravel\Ai\Enums\Lab;
use Laravel\Ai\Promptable;
use Stringable;

/**
 * ایجنت هوش مصنوعی مسئول تولید پست‌های دوزبانه وبلاگ.
 *
 * با گرفتن یک پرامت کوتاه از ادمین، یک مقاله کامل (عنوان، خلاصه،
 * دسته‌بندی و متن HTML) هم به فارسی و هم به انگلیسی تولید می‌کند.
 */
#[Provider(Lab::OpenAI)]
#[Model('gpt-4.1-mini')]
#[MaxTokens(8000)]
#[Temperature(0.7)]
class BlogPostGenerator implements Agent, HasStructuredOutput
{
    use Promptable;

    /**
     * دستورالعمل‌هایی که مدل باید هنگام نوشتن پست رعایت کند.
     */
    public function instructions(): Stringable|string
    {
        return <<<'TXT'
تو یک نویسنده حرفه‌ای محتوای وبلاگ هستی که مقاله‌های فنی و خواندنی برای یک
وبسایت دوزبانه (فارسی و انگلیسی) می‌نویسی.

قوانین مهم:
- بر اساس موضوع یا درخواستی که کاربر می‌دهد، یک مقاله کامل و باکیفیت و
  SEO-friendly تولید کن.
- خروجی باید هم نسخه فارسی (fa) و هم نسخه انگلیسی (en) داشته باشد. این دو
  نباید ترجمه لغت‌به‌لغت از هم باشند؛ هر کدام باید روان و طبیعی، متناسب با
  خواننده همان زبان نوشته شوند.
- فیلدهای content باید HTML معتبر و ساده باشند (فقط از تگ‌های h2, h3, p, ul,
  ol, li, strong, em, blockquote, a استفاده کن) چون داخل یک ادیتور Rich Text
  (Quill) نمایش داده می‌شوند. هرگز از تگ‌های h1, html, head, body, script یا
  استایل اینلاین استفاده نکن.
- متن فارسی باید با رعایت کامل نگارش صحیح فارسی و بدون غلط تایپی نوشته شود.
- excerpt باید یک یا دو جمله کوتاه و جذاب برای نمایش در کارت لیست پست‌ها
  باشد (حداکثر ۲۵ کلمه در هر زبان).
- category باید یک عبارت بسیار کوتاه (۱ تا ۳ کلمه) باشد، مثل «توسعه وب» یا
  "Web Development".
- طول content باید حداقل ۴۰۰ کلمه در هر زبان باشد، مگر اینکه کاربر طول
  دیگری درخواست کرده باشد.
- به هیچ عنوان محتوای غیرمرتبط، تبلیغاتی یا نامناسب تولید نکن.
TXT;
    }

    /**
     * ساختار خروجی (JSON Schema) که دقیقاً با فیلدهای فرم پست همخوانی دارد.
     */
    public function schema(JsonSchema $schema): array
    {
        return [
            'title_fa' => $schema->string()
                ->description('عنوان جذاب و کوتاه پست به فارسی')
                ->required(),

            'excerpt_fa' => $schema->string()
                ->description('خلاصه کوتاه فارسی، حداکثر ۲۵ کلمه')
                ->required(),

            'category_fa' => $schema->string()
                ->description('دسته‌بندی کوتاه فارسی (۱ تا ۳ کلمه)')
                ->required(),

            'content_fa' => $schema->string()
                ->description('محتوای کامل مقاله به صورت HTML ساده، به فارسی')
                ->required(),

            'title_en' => $schema->string()
                ->description('Short, catchy English title')
                ->required(),

            'excerpt_en' => $schema->string()
                ->description('Short English excerpt, max 25 words')
                ->required(),

            'category_en' => $schema->string()
                ->description('Short English category (1-3 words)')
                ->required(),

            'content_en' => $schema->string()
                ->description('Full article content as simple HTML, in English')
                ->required(),
        ];
    }
}
