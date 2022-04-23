<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHocPhisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoc_phis', function (Blueprint $table) {
            $table->id();
            $table->string('namhoc');
            $table->string('hocky');
            $table->string('mssv');
            $table->float('tong')->default(0);
            $table->float('dadong')->default(0);
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
        Schema::dropIfExists('hoc_phis');
    }
}
