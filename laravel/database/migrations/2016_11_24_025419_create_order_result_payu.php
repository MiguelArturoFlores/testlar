<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderResultPayu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orderresultpayu', function (Blueprint $table) {

            $table->increments('id');
            $table->integer('order_id');
            $table->string('payu_order_id',128);
            $table->string('payu_account_id',128);
            $table->string('reference_code',128);
            $table->string('description',512);
            $table->string('buyer_name',128);
            $table->string('buyer_email',128);
            $table->string('transaction_id',128);
            $table->string('transaction_state',128);
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
        //
    }
}
