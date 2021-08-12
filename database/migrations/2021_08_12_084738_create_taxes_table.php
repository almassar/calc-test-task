<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTaxesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('taxes', function (Blueprint $table) {
            $table->id();
            
            $table->integer('id_month');
            $table->integer('id_year');
           
            $table->decimal('ipn', 15, 3);
            $table->decimal('pension_contribution', 15, 3);
            $table->decimal('vosms', 15, 3);
            $table->decimal('osms', 15, 3);
            $table->decimal('social_contribution', 15, 3);

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
        Schema::dropIfExists('taxes');
    }
}
