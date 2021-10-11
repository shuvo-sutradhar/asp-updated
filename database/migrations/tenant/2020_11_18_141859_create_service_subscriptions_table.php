<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiceSubscriptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_subscriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('service_id')->unsigned()->index()->nullable();
            $table->foreign('service_id')->references('id')->on('services')->onDelete('cascade')->onUpdate('no action');
            $table->double('requring_price', 8, 2)->default(0.00);
            $table->smallInteger('requring_period')->default(1);
            $table->string('requring_for',20)->default('month');
            $table->double('trail_price', 8, 2)->default(0.00);
            $table->smallInteger('trail_period')->default(1);
            $table->string('trail_for',20)->default('month');
            $table->smallInteger('requiring_status')->default(0); // 0 means same order 1 means new order
            $table->smallInteger('request_quantity')->nullable(); // 0 means same order 1 means new order
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
        Schema::dropIfExists('service_subscriptions');
    }
}
