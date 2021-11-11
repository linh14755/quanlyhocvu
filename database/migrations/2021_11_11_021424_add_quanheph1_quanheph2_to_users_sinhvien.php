<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddQuanheph1Quanheph2ToUsersSinhvien extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('sinh_viens', function (Blueprint $table) {
            $table->string('quanheph1');
            $table->string('quanheph2');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('sinh_viens', function (Blueprint $table) {
            //
        });
    }
}
