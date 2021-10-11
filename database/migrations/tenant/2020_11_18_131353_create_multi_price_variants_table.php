<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMultiPriceVariantsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('multi_price_variants', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('multi_price_id')->unsigned()->index()->nullable();
            $table->foreign('multi_price_id')->references('id')->on('service_multi_prices')->onDelete('cascade')->onUpdate('no action');
            $table->string('name');
            $table->double('price', 8, 2);
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
        Schema::dropIfExists('multi_price_variants');
    }
}
