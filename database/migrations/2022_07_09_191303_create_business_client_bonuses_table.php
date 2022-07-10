<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('business_client_bonuses', function (Blueprint $table) {
            $table->id();

            $table->integer('balance')->default(0);

            $table->dateTime('activation_bonus_date')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->dateTime('deactivation_bonus_date')->nullable()->default(null);

            $table->foreignId('business_id');
            $table->foreign('business_id')->references('id')->on('businesses')->onDelete('cascade')->onUpdate('cascade');

            $table->foreignId('client_id');
            $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('business_client_bonuses');
    }
};
