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
        Schema::create('interfaces', function (Blueprint $table) {
            $table->id();
            $table->string('slide_palutungan')->nullable();
            $table->string('slide_linggarjati')->nullable();
            $table->string('slide_linggasana')->nullable();
            $table->string('slide_apuy')->nullable();

            $table->text('tentang_title')->nullable();
            $table->text('tentang_body')->nullable();

            $table->string('jalur_palutungan')->nullable();
            $table->string('jalur_linggarjati')->nullable();
            $table->string('jalur_linggasana')->nullable();
            $table->string('jalur_apuy')->nullable();
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
        Schema::dropIfExists('interfaces');
    }
};
