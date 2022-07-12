<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('phone_number', 12)->nullable();
            $table->string('email', 500)->nullable();
            $table->double('amount')->unsigned();
            $table->string('description', 500);
            $table->char('hash', 36)->unique()->nullable();
            $table->string('request_url', 500)->nullable();
            $table->string('redirect_url', 500)->nullable();
            $table->enum('status_id', ['paid', 'not_paid'])->default('not_paid');
            $table->string('paymentable_type', 500)->nullable();
            $table->unsignedBigInteger('paymentable_id')->index()->nullable();

            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete()->cascadeOnUpdate();

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
        Schema::dropIfExists('payments');
    }
};
