<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePollingExecutionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pollingExecutions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('age', $autoIncrement = false, $unsigned = true)->nullable(false)->change();
            $table->string('gender', 50)->default("M")->nullable(false)->change();
            $table->boolean('drivingLicenseOwned')->default(false)->nullable(false)->change();
            $table->string('drivetrain', 25)->default(null)->nullable(true)->change();
            $table->boolean('drifting')->default(null)->nullable(true)->change();
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
        Schema::dropIfExists('pollingExecutions');
    }
}
