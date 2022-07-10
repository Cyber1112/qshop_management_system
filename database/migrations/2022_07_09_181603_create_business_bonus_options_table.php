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
        Schema::create('business_bonus_options', function (Blueprint $table) {
            $table->id();
            $table->integer('bonus_percent')->comment('процент бонуса');
            $table->integer('activation_bonus_period')->default(0)->comment('период активации бонусов');
            $table->integer('deactivation_bonus_period')->nullable()->comment('период сгорания бонусов');

            $table->foreignId('business_id');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('business_bonus_options');
    }
};
