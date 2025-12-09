<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('khach_hang', function (Blueprint $table) {
            $table->string('MaKH', 10)->primary()->comment('Mã khách hàng');
            
            // Các trường bắt buộc
            $table->string('Email', 255)->unique()->comment('Email khách hàng');
            $table->string('MatKhau', 255)->comment('Mật khẩu đã mã hóa');
            $table->string('HoTen', 255)->comment('Họ tên khách hàng');

            $table->string('Sdt', 15)->nullable()->comment('Số điện thoại');
            $table->string('DiaChi', 500)->nullable()->comment('Địa chỉ');
            
            // Timestamps
            $table->timestamps();

            $table->index('Email');
            $table->index('Sdt');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('khach_hang');
    }
};
