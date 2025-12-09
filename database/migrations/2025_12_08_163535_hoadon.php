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
            // Khóa chính: MaHD (chuỗi, tự động gán bằng Model boot())
            $table->string('MaHD', 50)->primary(); 

            // Khóa ngoại MaKH (Liên kết đến bảng khach_hang)
            // Giả định MaKH là string
            $table->string('MaKH');
            $table->foreign('MaKH')->references('MaKH')->on('khach_hang')->onDelete('cascade');

            // Cột tổng tiền
            $table->decimal('TongTien', 10, 0)->default(0);
            
            // Cột trạng thái đơn hàng
            $table->string('TrangThai')->default('Chờ xử lý');

            // Cột ngày thanh toán (Ngày đặt hàng)
            // Sử dụng timestamp để lưu ngày giờ đầy đủ
            $table->timestamp('NgayThanhToan')->nullable();
            
            $table->timestamps();
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