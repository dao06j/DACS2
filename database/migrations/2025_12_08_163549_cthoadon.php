<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
       Schema::create('chi_tiet_hoa_don', function (Blueprint $table) {
    $table->string('MaCTHD', 10)->primary();

    $table->string('MaSP', 10);
    $table->string('MaHD', 10);

    $table->integer('SoLuong');
    $table->decimal('DonGia', 10, 0);
    $table->decimal('ThanhTien', 10, 0);

    $table->timestamps();

    $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');
    $table->foreign('MaHD')->references('MaHD')->on('hoa_don')->onDelete('cascade');
});
    }

    public function down(): void
    {
        Schema::dropIfExists('chi_tiet_hoa_don');
    }
};
