<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->text('description')->nullable();
            // service_type 0 means one_time service and service time 1 means requiring service
            $table->tinyInteger('service_type')->default(0);
            // pricing_type 0 means single_pricing and pricing_type 1 means multiple_pricing
            $table->tinyInteger('pricing_type')->default(0);
            $table->integer('currency');
            $table->boolean('review')->default(false);
            $table->boolean('comment')->default(true);
            $table->boolean('group_qty')->default(false);
            $table->string('deadline',50)->nullable();
            $table->boolean('status')->default(true);
            $table->boolean('layout_tbl')->default(true);
            $table->string('slug');
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
        Schema::dropIfExists('services');
    }
}
