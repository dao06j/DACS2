<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up(): void
    {
        Schema::create('sanpham', function (Blueprint $table) {
            
            $table->string('MaSP', 20)->primary(); 

            $table->string('TenSP', 255);
            $table->text('MoTa');

            $table->string('LoaiSP', 100)->index(); 

            $table->decimal('DonGia', 10, 2); 
            
            $table->string('HinhAnh', 255)->nullable(); 
            
            $table->integer('SLTonKho')->default(0);
            $table->integer('SLDaBan')->default(0);

            $table->string('TrangThai', 50)->default('Hiện');

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('sanpham');
    }
};