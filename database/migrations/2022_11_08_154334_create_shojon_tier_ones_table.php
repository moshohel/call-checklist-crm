<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateShojonTierOnesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shojon_tier_ones', function (Blueprint $table) {
            $table->id();
            $table->string('program_name')->nullable();
            $table->string('service_providers_name')->nullable();
            $table->string('service_providers_di')->nullable();
            $table->string('date')->nullable();
            $table->string('time')->nullable();
            $table->string('time_call_started')->nullable();
            $table->string('time_call_ended')->nullable();
            $table->string('duration')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('caller_id')->nullable();
            $table->string('caller_name')->nullable();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->string('occupation')->nullable();
            $table->string('location')->nullable();
            $table->string('socio_economic')->nullable();
            $table->string('hear_about_shojon')->nullable();
            $table->string('call_Type')->nullable();
            $table->string('caller')->nullable();
            $table->string('distress')->nullable();
            $table->string('primary_reason')->nullable();
            $table->text('secondary_reason')->nullable();
            $table->text('mental_illness_diagnosis')->nullable();
            $table->string('who')->nullable();
            $table->string('suicidal_risk')->nullable();
            $table->string('effective')->nullable();
            $table->string('internal_referr')->nullable();
            $table->string('reason_for_referral')->nullable();
            $table->string('name_of_agency')->nullable();
            $table->text('call_description')->nullable();
            $table->text('message')->nullable();
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
        Schema::dropIfExists('shojon_tier_ones');
    }
}
