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
            $table->foreignId('service_id')->constrained('services')->onDelete('cascade'); // Привязка к услуге
            $table->foreignId('complexity_id')->nullable()->constrained('service_complexities')->nullOnDelete(); // Сложность
            $table->string('code'); //Код Номенклатуры мед услуг
            $table->string('code_mis'); //Код МИС
            $table->string('name'); //Наименование мед услуги
            $table->string('duration'); //Продолжительность мед услуги в минутах
            $table->string('price'); //Цена мед услуги
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
