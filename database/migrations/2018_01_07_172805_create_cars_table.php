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
            $table->unsignedInteger('pollingExecution_id');
            $table->string('model')->nullable(false)->change();
            $table->timestamps();
            $table->foreign('pollingExecution_id')
                  ->references('id')
                  ->on('pollingExecutions')
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
            $table->dropForeign('cars_pollingExecution_id_foreign');
        });
        Schema::dropIfExists('cars');
    }
}
