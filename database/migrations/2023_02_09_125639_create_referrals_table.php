<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReferralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('referrals', function (Blueprint $table) {
            $table->id();
            $table->string('referr_to')->nullable();
            $table->string('referr_from')->nullable();
            $table->string('name')->nullable();
            $table->string('unique_id')->nullable();
            $table->string('age')->nullable();
            $table->string('gender')->nullable();
            $table->string('occupation')->nullable();
            $table->string('phone_number')->nullable();
            $table->string('phone_number_two')->nullable();
            $table->string('reason_for_therapy')->nullable();
            $table->string('preferred_time')->nullable();
            $table->string('preferred_therapist_or_psychiatrist')->nullable();
            $table->string('referred_therapist_or_psychiatrist')->nullable();
            $table->string('referred_therapist_or_psychiatrist_user_name')->nullable();
            $table->string('referred_therapist_or_psychiatrist_user_id')->nullable();
            $table->boolean('already_referred')->default(0);
            $table->boolean('appointment_status')->default(0);
            $table->string('financial')->nullable();
            $table->string('therapist')->nullable();
            $table->string('Referral_types')->nullable();
            $table->string('diagnosis')->nullable();
            $table->string('assigned_date_time')->nullable();
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
        Schema::dropIfExists('referrals');
    }
};