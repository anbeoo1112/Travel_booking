<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('gop_y', function (Blueprint $table) {
            $table->id();

            $table->string('ho_ten', 100);

            $table->string('so_dien_thoai', 20);

            $table->string('email', 50);

            $table->text('noidung_gopy');

            $table->string('trangthai', 50);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('gop_y');
    }
};
