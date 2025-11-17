<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('trang_tintuc', function (Blueprint $table) {
            $table->id();

            $table->foreignId('id_theloai')->constrained('the_loai');

            $table->string('id_nguoidung')->nullable();
            $table->foreign('id_nguoidung')->references('id')->on('nguoi_dung');

            $table->text('tieu_de');

            $table->text('slug');
            
            $table->text('mo_ta');
            
            $table->text('noidung_rutgon');
            
            $table->text('hinh_anh'); 
            
            $table->integer('doc')->default(0);
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('trang_tintuc');
    }
};
