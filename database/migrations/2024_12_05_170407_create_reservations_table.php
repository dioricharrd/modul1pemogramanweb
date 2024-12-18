<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Jalankan migration untuk membuat tabel reservations.
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->foreignId('villa_id')->constrained('villas')->onDelete('cascade'); // Relasi ke tabel villas
            $table->string('customer_name'); // Nama pelanggan
            $table->date('check_in'); // Tanggal check-in
            $table->date('check_out'); // Tanggal check-out
            $table->integer('number_of_guests'); // Jumlah tamu
            $table->timestamps(); // Kolom created_at dan updated_at
        });
    }

    /**
     * Reversi migration jika rollback.
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
