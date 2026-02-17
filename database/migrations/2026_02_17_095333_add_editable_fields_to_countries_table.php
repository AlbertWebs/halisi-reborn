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
        Schema::table('countries', function (Blueprint $table) {
            $table->text('hero_subtitle')->nullable()->after('hero_video');
            $table->text('narrative_image')->nullable()->after('hero_image');
            $table->string('signature_experiences_title')->nullable()->after('signature_experiences');
            $table->string('conservation_title')->nullable()->after('conservation_focus');
            $table->text('conservation_visual_text')->nullable()->after('conservation_title');
            $table->string('featured_journeys_title')->nullable()->after('conservation_visual_text');
            $table->string('featured_journeys_button_text')->nullable()->after('featured_journeys_title');
            $table->string('cta_title')->nullable()->after('cta_link');
            $table->text('cta_description')->nullable()->after('cta_title');
            $table->string('cta_button_text')->nullable()->after('cta_description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn([
                'hero_subtitle',
                'narrative_image',
                'signature_experiences_title',
                'conservation_title',
                'conservation_visual_text',
                'featured_journeys_title',
                'featured_journeys_button_text',
                'cta_title',
                'cta_description',
                'cta_button_text',
            ]);
        });
    }
};
