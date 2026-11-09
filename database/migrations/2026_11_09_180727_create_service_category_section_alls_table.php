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
        Schema::create('service_category_section_alls', function (Blueprint $table) {
            $table->id();
            $table->string('name'); // Название секции
            $table->text('description'); // Описание секции
            $table->string('image')->nullable(); // Изображение секции
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_category_section_alls');
    }
};
