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
            $table->string('contact_section_title')->nullable()->after('empty_state_message');
            $table->text('contact_section_intro')->nullable()->after('contact_section_title');
            $table->string('contact_form_title')->nullable()->after('contact_section_intro');
            $table->text('contact_form_intro')->nullable()->after('contact_form_title');
            $table->string('contact_form_button_label')->nullable()->after('contact_form_intro');
            $table->text('contact_map_embed_url')->nullable()->after('contact_form_button_label');
            $table->string('contact_email_label')->nullable()->after('contact_map_embed_url');
            $table->string('contact_phone_label')->nullable()->after('contact_email_label');
            $table->string('contact_address_label')->nullable()->after('contact_phone_label');
            $table->string('contact_hours_label')->nullable()->after('contact_address_label');
            $table->string('contact_social_label')->nullable()->after('contact_hours_label');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn([
                'contact_section_title',
                'contact_section_intro',
                'contact_form_title',
                'contact_form_intro',
                'contact_form_button_label',
                'contact_map_embed_url',
                'contact_email_label',
                'contact_phone_label',
                'contact_address_label',
                'contact_hours_label',
                'contact_social_label',
            ]);
        });
    }
};
