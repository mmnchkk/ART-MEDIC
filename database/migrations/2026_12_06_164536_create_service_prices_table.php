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
        Schema::create('service_prices', function (Blueprint $table) {
            $table->id();
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade');
            $table->string('code'); // Привязка к услуге
            $table->string('code_mis'); //Код МИС
            $table->string('name'); //Наименование мед услуги
            $table->string('duration'); //Продолжительность мед услуги в минутах
            $table->string('price')->nullable(); //Цена мед услуги

            $table->decimal('price_category_1', 10, 2)->nullable(); // Категория I
            $table->decimal('price_category_2', 10, 2)->nullable(); // Категория II
            $table->decimal('price_category_3', 10, 2)->nullable(); // Категория III
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_prices');
    }
};
