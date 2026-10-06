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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->string('first_name'); //имя оценщика
            $table->string('middle_name')->nullable(); //отчество оценщика
            $table->string('last_name')->nullable(); //фамилия оценщика
            $table->integer('rating'); //рейтинг не меньше 1 и не больше 5
            $table->text('desc_story'); //описание истории (как оценщик узнал о клинике, что его привлекло, почему он выбрал именно эту клинику)
            $table->text('desc_like'); //описание того, что liked
            $table->date('date'); //дата оценки
            $table->timestamps();
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
