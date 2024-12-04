<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('devs', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('nivel_id');

            $table->string('nome');
            $table->char('sexo', 1);  // 1 caractere para sexo (M ou F)
            $table->date('data_nascimento');
            $table->string('hobby');

            $table->foreign('nivel_id')->references('id')->on('niveis')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('devs');
    }
};
