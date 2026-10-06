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
        Schema::create('specialists', function (Blueprint $table) {
            $table->id();
            $table->string('lastname'); //фамилия
            $table->string('name'); //имя
            $table->string('middle_name'); //отчество
            $table->text('description'); //описание
            $table->integer('experience'); //опыт
            $table->integer('count_operations'); //количество операций
            $table->integer('percentage_reviews'); //процент отзывов
            $table->string('image'); //изображение
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('specialists');
    }
};
