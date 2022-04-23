<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiemDanhsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diem_danhs', function (Blueprint $table) {
            $table->id();
            $table ->string('mssv');
            $table ->string('malhp');
            $table ->date('ngay');
            $table ->string('trangthai')->nullable();
            $table->string('tiet');

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
        Schema::dropIfExists('diem_danhs');
    }
}
