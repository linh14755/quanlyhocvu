<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDiemRenLuyensTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('diem_ren_luyens', function (Blueprint $table) {
            $table->id();
            $table->string('masv');
            $table->string('diem')->nullable();
            $table->string('xeploai')->nullable();
            $table->string('namhoc');
            $table->string('hocky');
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
        Schema::dropIfExists('diem_ren_luyens');
    }
}
