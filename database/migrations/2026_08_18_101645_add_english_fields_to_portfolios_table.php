<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->string('title_en')->nullable();
            $table->string('slug_en')->nullable()->unique();
            $table->string('short_description_en')->nullable();
            $table->text('description_en')->nullable();
            $table->string('client_name_en')->nullable();
            $table->string('duration_en')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropColumn([
                'title_en',
                'slug_en',
                'short_description_en',
                'description_en',
                'client_name_en',
                'duration_en',
            ]);
        });
    }
};
