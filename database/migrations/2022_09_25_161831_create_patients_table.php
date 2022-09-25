<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('patients', function (Blueprint $table) {
            $table->id();
            $table->string('phone_number')->nullable();
            $table->string('name')->nullable();
            $table->string('unique_id')->index();
            $table->unsignedBigInteger('caller_id')->index()->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->string('occupation')->nullable();
            $table->string('socio_economic_status')->nullable();
            $table->string('location')->nullable();
            $table->string('hearing_source')->nullable();
            $table->longText('caller_description')->nullable();
            $table->integer('created_by')->unsigned()->nullable();
            $table->integer('updated_by')->unsigned()->nullable();
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
        Schema::dropIfExists('patients');
    }
}
