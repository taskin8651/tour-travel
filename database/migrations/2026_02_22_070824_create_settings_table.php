<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('settings', function (Blueprint $table) {
        $table->id();

        // General
        $table->string('site_name')->nullable();
        $table->string('tagline')->nullable();
        $table->string('currency')->default('₹');
        $table->boolean('maintenance_mode')->default(0);

        // Contact
        $table->string('phone')->nullable();
        $table->string('whatsapp')->nullable();
        $table->string('email')->nullable();
        $table->text('address')->nullable();
        $table->text('google_map')->nullable();

        // Social
        $table->string('facebook')->nullable();
        $table->string('instagram')->nullable();
        $table->string('twitter')->nullable();
        $table->string('youtube')->nullable();

        // SEO
        $table->string('meta_title')->nullable();
        $table->text('meta_description')->nullable();
        $table->text('google_analytics')->nullable();

        // Footer
        $table->text('footer_about')->nullable();
        $table->string('copyright_text')->nullable();

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
