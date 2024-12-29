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
        Schema::create('villa_events', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('villa_id'); // Relasi ke villa
            $table->string('name'); // Nama event (misal: BBQ Night)
            $table->text('description'); // Deskripsi event
            $table->dateTime('start_date'); // Tanggal mulai event
            $table->dateTime('end_date'); // Tanggal selesai event
            $table->timestamps();
    
            // Relasi ke tabel villa
            $table->foreign('villa_id')->references('id')->on('villas')->onDelete('cascade');
        });
    }
    
    public function down()
    {
        Schema::dropIfExists('villa_events');
    }
};