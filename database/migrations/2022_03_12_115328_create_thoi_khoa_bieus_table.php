<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThoiKhoaBieusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('thoi_khoa_bieus', function (Blueprint $table) {
            $table->id();
            $table->string("malhp");
            $table->string("mahp");
            $table->string("tenhp");
            $table->string("nhom");
            $table->string("lop");
            $table->string("tiet");
            $table->string("phong");
            $table->string("giaovien");
            $table->string("dahoc");
            $table->string("ngay");
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
        Schema::dropIfExists('thoi_khoa_bieus');
    }
}
