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
            $table->string('signature_card_1_label')->nullable()->after('signature_experiences_title');
            $table->string('signature_card_2_label')->nullable()->after('signature_card_1_label');
            $table->string('signature_card_3_label')->nullable()->after('signature_card_2_label');
            $table->string('signature_card_4_label')->nullable()->after('signature_card_3_label');
            $table->string('conservation_button_text')->nullable()->after('conservation_visual_text');
            $table->string('conservation_button_link')->nullable()->after('conservation_button_text');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn([
                'signature_card_1_label',
                'signature_card_2_label',
                'signature_card_3_label',
                'signature_card_4_label',
                'conservation_button_text',
                'conservation_button_link',
            ]);
        });
    }
};
