<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('polling_execution_id');
            $table->string('model');
            $table->timestamps();
            $table->foreign('polling_execution_id')
                  ->references('id')
                  ->on('polling_executions')
                  ->onDelete('cascade')
                  ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cars', function(Blueprint $table) {
            $table->dropForeign('cars_polling_execution_id_foreign');
        });
        Schema::dropIfExists('cars');
    }
}
