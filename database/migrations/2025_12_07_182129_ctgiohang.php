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
        Schema::create('chitietgiohang', function (Blueprint $table) {
            $table->string('MaCTGH', 50)->primary(); 
            $table->string('MaSP');
            $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');

            // Khóa ngoại liên kết đến bảng KhachHang
            // Giả định MaKH là string
            $table->string('MaKH');
            $table->foreign('MaKH')->references('MaKH')->on('khach_hang')->onDelete('cascade');

            // Các cột khác
            $table->integer('SoLuong')->default(1); 
            $table->decimal('ThanhTien', 10, 0); 
            
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chitietgiohang');
    }
};