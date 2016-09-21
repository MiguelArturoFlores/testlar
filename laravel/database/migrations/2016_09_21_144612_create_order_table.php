<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('storeorder', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('state');
                $table->integer('user_id');
                $table->integer('delivery_type');
                $table->integer('payment_type');
                $table->string('coupon_code')->nullable();
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
            
        Schema::dropIfExists('storeorder');
        
    }
}
