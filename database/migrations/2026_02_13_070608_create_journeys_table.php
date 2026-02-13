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
        Schema::create('journeys', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug')->unique();
            $table->text('hero_image')->nullable();
            $table->text('narrative_intro');
            $table->text('experience_highlights')->nullable();
            $table->text('regenerative_impact')->nullable();
            $table->string('cta_label')->nullable();
            $table->string('cta_link')->nullable();
            $table->string('journey_category')->nullable(); // signature-safaris, bespoke-private-travel, conservation-community, luxury-retreats
            $table->boolean('is_published')->default(false);
            $table->integer('sort_order')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('journeys');
    }
};
