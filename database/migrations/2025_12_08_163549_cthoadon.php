<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('chi_tiet_hoa_don', function (Blueprint $table) {
            $table->string('MaCTHD', 50)->primary(); 

            $table->string('MaSP');
            $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');
            $table->string('MaHD'); 
            $table->foreign('MaHD')->references('MaHD')->on('hoa_don')->onDelete('cascade');

            $table->integer('SoLuong');
            $table->decimal('DonGia', 10, 0); 
            $table->decimal('ThanhTien', 10, 0); 
            
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_hoa_don');
    }
};