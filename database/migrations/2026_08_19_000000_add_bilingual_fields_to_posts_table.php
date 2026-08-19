<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * این migration ستون‌های فعلی title/category/excerpt/content را
 * به نسخه فارسی (_fa) تبدیل می‌کند و معادل انگلیسی (_en) آن‌ها را
 * اضافه می‌کند تا هر پست بتواند به‌صورت دوزبانه ثبت شود.
 *
 * نکته: renameColumn به پکیج doctrine/dbal نیاز دارد:
 *   composer require doctrine/dbal
 */
return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('title', 'title_fa');
            $table->renameColumn('category', 'category_fa');
            $table->renameColumn('excerpt', 'excerpt_fa');
            $table->renameColumn('content', 'content_fa');
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->string('title_en')->nullable()->after('title_fa');
            $table->string('category_en')->nullable()->after('category_fa');
            $table->text('excerpt_en')->nullable()->after('excerpt_fa');
            $table->longText('content_en')->nullable()->after('content_fa');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropColumn(['title_en', 'category_en', 'excerpt_en', 'content_en']);
        });

        Schema::table('posts', function (Blueprint $table) {
            $table->renameColumn('title_fa', 'title');
            $table->renameColumn('category_fa', 'category');
            $table->renameColumn('excerpt_fa', 'excerpt');
            $table->renameColumn('content_fa', 'content');
        });
    }
};
