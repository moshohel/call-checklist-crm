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
            $table->string('phone_number')->nullable();
            $table->string('phone_number_two')->nullable();
            $table->string('reason_for_therapy')->nullable();
            $table->string('preferred_time')->nullable();
            $table->string('preferred_therapist_or_psychiatrist')->nullable();
            $table->boolean('already_referred')->default(0);
            $table->string('financial')->nullable();
            $table->string('referred_therapist_or_psychiatrist')->nullable();
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
