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
    Schema::create('listings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('category_id')->constrained()->onDelete('cascade');
        $table->foreignId('sub_category_id')->constrained()->onDelete('cascade');

        $table->string('title');
        $table->string('location')->nullable();
        $table->decimal('price', 10, 2)->nullable();

        $table->integer('rooms')->nullable();
        $table->integer('seats')->nullable();
        $table->integer('days')->nullable();

        $table->text('description')->nullable();
        $table->string('image')->nullable();

        $table->boolean('status')->default(1);

        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('listings');
    }
};
