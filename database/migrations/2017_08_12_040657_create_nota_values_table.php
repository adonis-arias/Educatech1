<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNotaValuesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nota_values', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('nota');
            $table->integer('nota_structures_id')->unsigned();
            $table->foreign('nota_structures_id')
                  ->references('id')
                  ->on('notas_structures')
                  ->onDelete('cascade');
            $table->integer('student_id')->unsigned();
            $table->foreign('student_id')
                  ->references('id')
                  ->on('students')
                  ->onDelete('cascade');
            $table->integer('period _ranges_id')->unsigned();
            $table->foreign('period_ranges_id')
                  ->references('id')
                  ->on('periods_ranges')
                  ->onDelete('cascade');
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
        Schema::dropIfExists('nota_values');
    }
}
