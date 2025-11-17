<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('dat_tour', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->string('id_nguoidung')->nullable();
            $table->foreign('id_nguoidung')->references('id')->on('nguoi_dung');

            $table->string('id_khachhang')->nullable();
            $table->foreign('id_khachhang')->references('id')->on('nguoi_dung');

            $table->string('id_tour')->nullable();
            $table->foreign('id_tour')->references('id')->on('tour');

            $table->string('ho_ten', 100);

            $table->string('email', 50);

            $table->string('so_dien_thoai', 20);

            $table->integer('so_nguoi');

            $table->date('ngay_di');

            $table->string('trang_thai_dattour', 50);

            $table->dateTime('ngay_dat_tour');
            
            $table->dateTime('ngay_huy_tour')->nullable();
        });
    }

    public function down()
    {
        Schema::dropIfExists('dat_tour');
    }
};
