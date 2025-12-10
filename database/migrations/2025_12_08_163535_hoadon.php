<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations (Tạo bảng HoaDon).
     */
    public function up(): void
    {
       Schema::create('hoa_don', function (Blueprint $table) {
    $table->string('MaHD', 10)->primary();
    $table->string('MaKH', 10);

    $table->decimal('TongTien', 10, 0)->default(0);
    $table->string('TrangThai')->default('Chờ xử lý');
    $table->timestamp('NgayThanhToan')->nullable();

    $table->timestamps();

    $table->foreign('MaKH')->references('MaKH')->on('khach_hang')->onDelete('cascade');
});
    }

    /**
     * Reverse the migrations (Xóa bảng HoaDon).
     */
    public function down(): void
    {
        Schema::dropIfExists('hoa_don');
    }
};
