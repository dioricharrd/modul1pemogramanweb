<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGalleriesTable extends Migration
{
    public function up()
    {
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('villa_id'); // Relasi ke tabel villas
            $table->string('image_path');          // Path gambar
            $table->string('caption')->nullable(); // Caption opsional untuk gambar
            $table->timestamps();

            // Foreign key ke tabel villas
            $table->foreign('villa_id')->references('id')->on('villas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('galleries');
    }
}
