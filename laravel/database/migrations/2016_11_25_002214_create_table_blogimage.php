<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableBlogimage extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

        $hasTable = Schema::hasTable('blogimage', function (Blueprint $table) {

        });

        if (!$hasTable) {
            Schema::create('blogimage', function (Blueprint $table) {

                $table->increments('id');
                $table->string('entire_name')->unique();
                $table->string('folder', 128);
                $table->string('original_name', 256);
                $table->timestamps();

            });
        }
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
