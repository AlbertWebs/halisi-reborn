<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->text('destination_brief_lead')->nullable()->after('signature_experiences');
            $table->string('destination_brief_capital')->nullable()->after('destination_brief_lead');
            $table->string('destination_brief_currency')->nullable()->after('destination_brief_capital');
            $table->string('destination_brief_languages')->nullable()->after('destination_brief_currency');
            $table->string('destination_brief_time_zone')->nullable()->after('destination_brief_languages');
            $table->string('destination_brief_airports')->nullable()->after('destination_brief_time_zone');
            $table->string('destination_brief_best_for')->nullable()->after('destination_brief_airports');
            $table->string('destination_brief_ideal_trip_length')->nullable()->after('destination_brief_best_for');
            $table->string('destination_brief_best_time')->nullable()->after('destination_brief_ideal_trip_length');
            $table->string('destination_brief_travel_style')->nullable()->after('destination_brief_best_time');
            $table->string('destination_brief_ecosystems')->nullable()->after('destination_brief_travel_style');
            $table->string('destination_brief_entry_requirements')->nullable()->after('destination_brief_ecosystems');
            $table->string('destination_brief_health_notes')->nullable()->after('destination_brief_entry_requirements');

            $table->text('destination_brief_climate_intro')->nullable()->after('destination_brief_health_notes');
            $table->string('destination_brief_climate_1_season')->nullable()->after('destination_brief_climate_intro');
            $table->string('destination_brief_climate_1_note')->nullable()->after('destination_brief_climate_1_season');
            $table->string('destination_brief_climate_2_season')->nullable()->after('destination_brief_climate_1_note');
            $table->string('destination_brief_climate_2_note')->nullable()->after('destination_brief_climate_2_season');
            $table->string('destination_brief_climate_3_season')->nullable()->after('destination_brief_climate_2_note');
            $table->string('destination_brief_climate_3_note')->nullable()->after('destination_brief_climate_3_season');

            $table->string('highlights_title')->nullable()->after('destination_brief_climate_3_note');
            $table->string('highlight_1_title')->nullable()->after('highlights_title');
            $table->text('highlight_1_text')->nullable()->after('highlight_1_title');
            $table->string('highlight_1_image')->nullable()->after('highlight_1_text');
            $table->string('highlight_2_title')->nullable()->after('highlight_1_image');
            $table->text('highlight_2_text')->nullable()->after('highlight_2_title');
            $table->string('highlight_2_image')->nullable()->after('highlight_2_text');
            $table->string('highlight_3_title')->nullable()->after('highlight_2_image');
            $table->text('highlight_3_text')->nullable()->after('highlight_3_title');
            $table->string('highlight_3_image')->nullable()->after('highlight_3_text');
            $table->string('highlight_4_title')->nullable()->after('highlight_3_image');
            $table->text('highlight_4_text')->nullable()->after('highlight_4_title');
            $table->string('highlight_4_image')->nullable()->after('highlight_4_text');
        });
    }

    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn([
                'destination_brief_lead',
                'destination_brief_capital',
                'destination_brief_currency',
                'destination_brief_languages',
                'destination_brief_time_zone',
                'destination_brief_airports',
                'destination_brief_best_for',
                'destination_brief_ideal_trip_length',
                'destination_brief_best_time',
                'destination_brief_travel_style',
                'destination_brief_ecosystems',
                'destination_brief_entry_requirements',
                'destination_brief_health_notes',
                'destination_brief_climate_intro',
                'destination_brief_climate_1_season',
                'destination_brief_climate_1_note',
                'destination_brief_climate_2_season',
                'destination_brief_climate_2_note',
                'destination_brief_climate_3_season',
                'destination_brief_climate_3_note',
                'highlights_title',
                'highlight_1_title',
                'highlight_1_text',
                'highlight_1_image',
                'highlight_2_title',
                'highlight_2_text',
                'highlight_2_image',
                'highlight_3_title',
                'highlight_3_text',
                'highlight_3_image',
                'highlight_4_title',
                'highlight_4_text',
                'highlight_4_image',
            ]);
        });
    }
};
