<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePhuHuynhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('phu_huynhs', function (Blueprint $table) {
            $table->id();
            $table->string('tenph');
            $table->string('sodt');
            $table->string('matkhau');
            $table->string('diachi');
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
        Schema::dropIfExists('phu_huynhs');
    }
}
