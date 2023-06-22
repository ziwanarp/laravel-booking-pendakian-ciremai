<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('kuota_id');
            $table->string('kode_order')->unique();
            $table->integer('harga');
            $table->string('tanggal_naik');
            $table->string('tanggal_turun');
            $table->enum('status', ['Pending', 'Konfirmasi','Tolak']);
            $table->integer('reschedule')->default(0);
            $table->integer('jumlah_pendaki');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('orders');
    }
};
