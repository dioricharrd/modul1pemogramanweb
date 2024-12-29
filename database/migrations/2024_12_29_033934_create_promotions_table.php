<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePromotionsTable extends Migration
{
    public function up()
    {
        Schema::create('promotions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('villa_id'); // Relasi ke tabel villas
            $table->string('title');               // Judul promosi
            $table->text('description')->nullable(); // Deskripsi promosi
            $table->decimal('discount_percentage', 5, 2); // Persentase diskon
            $table->date('valid_from');            // Tanggal mulai berlaku
            $table->date('valid_until');           // Tanggal akhir berlaku
            $table->timestamps();

            // Foreign key ke tabel villas
            $table->foreign('villa_id')->references('id')->on('villas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('promotions');
    }
}
