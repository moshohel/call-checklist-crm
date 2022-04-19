<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallChecklistForKprTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_checklist_for_kpr', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('referrence_id')->index()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('agent')->nullable();
            $table->dateTime('call_received')->nullable();
            $table->dateTime('call_started')->nullable();
            $table->dateTime('call_ended')->nullable();
            $table->string('caller_name')->nullable();
            $table->enum('sex', ['Male', 'Female', 'Intersex', 'Others']);
            $table->string('age');
            $table->string('occupation');
            $table->string('location')->nullable();
            $table->string('call_type');
            $table->string('caller');
            $table->string('risk_level');
            $table->string('main_reason_for_calling');
            $table->string('secondary_reason_for_calling')->nullable();
            $table->string('caller_experience');
            $table->string('client_referral');
            $table->text('caller_description');
            $table->unsignedInteger('is_synced');
            $table->unsignedInteger('sync_try_count');
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
        Schema::dropIfExists('call_checklist_for_kpr');
    }
}
