<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChiTietLopHocPhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chi_tiet_lop_hoc_phans', function (Blueprint $table) {
            $table->id();
            $table->string('malhp');
            $table->string('masv');
            $table->string('mahp');
            $table->string('ngaydk')->nullable();
            $table->string('diemqt')->nullable();
            $table->string('phantramqt')->nullable();
            $table->string('dieml1')->nullable();
            $table->string('phantraml1')->nullable();
            $table->string('dieml2')->nullable();
            $table->string('phantraml2')->nullable();
            $table->string('diemtk')->nullable();
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
        Schema::dropIfExists('chi_tiet_lop_hoc_phans');
    }
}
