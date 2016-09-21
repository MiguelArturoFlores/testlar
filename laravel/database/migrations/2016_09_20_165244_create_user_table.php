<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
            Schema::create('storeuser', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('lastname');
                $table->string('email')->unique();
                $table->string('password');
                $table->string('address');
                $table->integer('default_role')->default(0);
                $table->rememberToken();
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
        Schema::dropIfExists('storeuser');
    }
}
