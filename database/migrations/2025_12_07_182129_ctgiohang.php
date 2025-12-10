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
    $table->string('MaCTGH', 10)->primary();

    $table->string('MaSP', 10);
    $table->string('MaKH', 10);

    $table->integer('SoLuong')->default(1);
    $table->decimal('ThanhTien', 10, 0);

    $table->timestamps();

    // Foreign keys
    $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');
    $table->foreign('MaKH')->references('MaKH')->on('khach_hang')->onDelete('cascade');
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
