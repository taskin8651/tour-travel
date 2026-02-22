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
    Schema::create('enquiries', function (Blueprint $table) {
        $table->id();

        $table->foreignId('listing_id')
              ->constrained()
              ->onDelete('cascade');

        $table->string('name');
        $table->string('email')->nullable();
        $table->string('phone');

        $table->date('travel_date')->nullable();
        $table->integer('persons')->nullable();

        $table->text('message')->nullable();

        $table->enum('status', ['pending','confirmed','cancelled'])
              ->default('pending');

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enquiries');
    }
};
