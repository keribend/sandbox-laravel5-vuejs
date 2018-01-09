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
        Schema::create('polling_executions', function (Blueprint $table) {
            $table->increments('id');
            $table->tinyInteger('age', $autoIncrement = false, $unsigned = true);
            $table->string('gender', 50)->default("M");
            $table->boolean('drivingLicenseOwned')->default(false);
            $table->string('drivetrain', 10)->default(null)->nullable();
            $table->boolean('drifting')->default(null)->nullable();
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
        Schema::dropIfExists('polling_executions');
    }
}
