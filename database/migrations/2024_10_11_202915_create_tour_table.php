<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('tour', function (Blueprint $table) {
            $table->string('id')->primary();

            $table->foreignId('id_LoaiTour')->constrained('loai_tour');

            $table->text('ten_tour')->unique;

            $table->string('thoigian_tour', 50);

            $table->text('slug');

            $table->string('noi_khoi_hanh', 100);

            $table->decimal('gia', 10, 0);

            $table->text('mo_ta')->nullable();
            
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('tour');
    }
};
