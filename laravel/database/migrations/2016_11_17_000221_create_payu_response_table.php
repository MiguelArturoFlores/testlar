<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayuResponseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        Schema::create('storeorderpayu', function (Blueprint $table) {
            $table->integer('order_id');
            $table->string('merchant_id', 32);
            $table->string('state_pol', 32);
            $table->string('risk', 32);
            $table->string('response_code_pol', 255);
            $table->string('reference_sale', 255);
            $table->string('reference_pol', 255);
            $table->string('sign', 255);
            $table->string('extra1', 255);
            $table->string('extra2', 255);
            $table->string('payment_method', 255);
            $table->string('payment_method_type', 255);
            $table->string('installments_number', 255);
            $table->string('value', 255);
            $table->string('tax', 255);
            $table->string('additional_value', 255);
            $table->string('transaction_date', 255);
            $table->string('currency', 255);
            $table->string('email_buyer', 255);
            $table->string('response_message_pol', 255);
            $table->string('payment_method_id', 255);
            $table->string('payment_method_name', 255);
            $table->string('ip', 255);
            $table->string('commision_pol', 255);
            $table->string('billing_address', 255);
            $table->string('shipping_address', 255);
            $table->string('phone', 255);
            $table->string('date', 255);
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
