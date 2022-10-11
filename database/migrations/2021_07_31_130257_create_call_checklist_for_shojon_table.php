<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCallChecklistForShojonTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('call_checklist_for_shojon', function (Blueprint $table) {
            $table->bigIncrements('id')->unsigned();
            $table->unsignedBigInteger('referrence_id')->index()->nullable();
            $table->string('phone_number')->nullable();
            $table->string('agent')->nullable();
            $table->dateTime('call_received')->nullable();
            $table->dateTime('call_started')->nullable();
            $table->dateTime('call_ended')->nullable();
            $table->integer('customer_sec')->nullable();
            $table->string('caller_name')->nullable();
            $table->unsignedBigInteger('caller_id')->index();
            $table->string('sex')->nullable();
            $table->string('age')->nullable();
            $table->string('occupation')->nullable();
            $table->string('socio_economic_status')->nullable();
            $table->string('location')->nullable();
            $table->string('hearing_source')->nullable();
            $table->boolean('is_recordable')->default(0);
            $table->string('call_type')->nullable();
            $table->string('caller')->nullable();
            $table->string('service')->nullable();
            $table->tinyInteger('pre_mood_rating')->nullable();
            $table->string('main_reason_for_calling')->nullable();
            $table->string('secondary_reason_for_calling')->nullable();
            $table->string('mental_illness_diagnosis')->nullable();
            $table->string('ghq')->nullable();
            $table->string('suicidal_risk')->nullable();
            $table->string('post_mood_rating')->nullable();
            $table->string('call_effectivenes')->nullable();
            $table->string('client_referral')->nullable();
            $table->text('financial_affordability')->nullable();
            $table->longText('caller_description')->nullable();
            $table->unsignedInteger('is_synced')->defautl(0);
            $table->unsignedInteger('sync_try_count')->default(0);
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
        Schema::dropIfExists('call_checklist_for_shojon');
    }
}
