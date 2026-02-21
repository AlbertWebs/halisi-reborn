<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->string('signature_card_1_image')->nullable()->after('signature_card_4_label');
            $table->string('signature_card_1_video')->nullable()->after('signature_card_1_image');
            $table->string('signature_card_2_image')->nullable()->after('signature_card_1_video');
            $table->string('signature_card_2_video')->nullable()->after('signature_card_2_image');
            $table->string('signature_card_3_image')->nullable()->after('signature_card_2_video');
            $table->string('signature_card_3_video')->nullable()->after('signature_card_3_image');
            $table->string('signature_card_4_image')->nullable()->after('signature_card_3_video');
            $table->string('signature_card_4_video')->nullable()->after('signature_card_4_image');
        });
    }

    public function down(): void
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn([
                'signature_card_1_image', 'signature_card_1_video',
                'signature_card_2_image', 'signature_card_2_video',
                'signature_card_3_image', 'signature_card_3_video',
                'signature_card_4_image', 'signature_card_4_video',
            ]);
        });
    }
};
