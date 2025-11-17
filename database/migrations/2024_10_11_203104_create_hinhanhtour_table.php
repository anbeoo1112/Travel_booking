<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('hinhanh_tour', function (Blueprint $table) {
            $table->id();

            $table->string('id_tour')->nullable();
            $table->foreign('id_tour')->references('id')->on('tour');

            $table->text('ten_anh');

            $table->text('url_anh');
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('hinhanh_tour');
    }
};
