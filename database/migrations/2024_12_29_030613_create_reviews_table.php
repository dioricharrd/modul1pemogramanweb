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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('villa_id'); // Relasi ke villa
            $table->string('customer_name');
            $table->text('review');
            $table->integer('rating')->default(1); // Nilai antara 1-5
            $table->timestamps();
    
            // Foreign key constraint
            $table->foreign('villa_id')->references('id')->on('villas')->onDelete('cascade');
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
