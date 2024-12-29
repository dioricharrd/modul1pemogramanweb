<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFacilitiesTable extends Migration
{
    public function up()
    {
        Schema::create('facilities', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('villa_id'); // Relasi ke tabel villas
            $table->string('name');               // Nama fasilitas
            $table->text('description')->nullable(); // Deskripsi fasilitas
            $table->timestamps();

            // Tambahkan foreign key ke tabel villas
            $table->foreign('villa_id')->references('id')->on('villas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('facilities');
    }
}
