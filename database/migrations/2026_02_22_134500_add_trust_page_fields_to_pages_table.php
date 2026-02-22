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
        Schema::table('pages', function (Blueprint $table) {
            $table->string('featured_label')->nullable()->after('content_image_2');
            $table->string('latest_articles_title')->nullable()->after('featured_label');
            $table->text('latest_articles_description')->nullable()->after('latest_articles_title');
            $table->text('empty_state_message')->nullable()->after('latest_articles_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'featured_label',
                'latest_articles_title',
                'latest_articles_description',
                'empty_state_message',
            ]);
        });
    }
};
