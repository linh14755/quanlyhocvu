<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHocPhansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('hoc_phans', function (Blueprint $table) {
            $table->string('mahp')->primary();
            $table->string('tenhp');
            $table->string('loai');
            $table->string('stc');
            $table->string('sotclt')->nullable();
            $table->string('sotcth')->nullable();
            $table->string('dongialt')->nullable();
            $table->string('dongiath')->nullable();
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
        Schema::dropIfExists('hoc_phans');
    }
}
