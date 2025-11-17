<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Crypt;


class AdminSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('nguoi_dung')->insert([
            'id' => 'admin',
            'ho_ten' => 'admin',
            'tai_khoan' => 'admin',
            'mat_khau' => Crypt::encrypt('admin'), // Mã hóa mật khẩu
            'so_dien_thoai' => '0123456789',
            'email' => 'admin@gmail.com',
            'avatar' => '',
            'vai_tro' => 'admin',
            'dang_nhap_qua' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
