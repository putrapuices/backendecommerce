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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice');
            $table->unsignedBigInteger('customer_id');
            $table->string('courier');
            $table->string('courier_service');
            $table->bigInteger('courier_cost');
            $table->integer('weight');
            $table->string('name');
            $table->string('phone');
            $table->unsignedBigInteger('city_id');
            $table->unsignedBigInteger('province_id');
            $table->text('address');
            $table->enum('status', array('pending', 'success', 'expired', 'failed'));
            $table->bigInteger('grand_total');
            $table->string('snap_token')->nullable();
            $table->timestamps();

            //relationship customer
            $table->foreign('customer_id')->references('id')->on('customers');

            //relationship city
            $table->foreign('city_id')->references('id')->on('cities');

            //relationship province
            $table->foreign('province_id')->references('id')->on('provinces');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
};
