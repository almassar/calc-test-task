<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSalariesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('salaries', function (Blueprint $table) {
            $table->id();

            $table->integer('salary', 0)->comment('Оклад в тенге');
            $table->integer('ipn', 0)->comment('Индивидуальный подоходный налог');
            $table->integer('pension_contribution', 0)->comment('Обязательный пенсионный взнос');
            $table->integer('osms', 0)->comment('Обязательное социальное медицинское страхование');
            $table->integer('vosms', 0)->comment('Взносы на обязательное социальное медицинское страхование');
            $table->integer('social_contribution', 0)->comment('Социальное отчисление');
            $table->integer('salary_result', 0)->comment('Зарплата с учетом вычетов всех налогов');

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
        Schema::dropIfExists('salaries');
    }
}
