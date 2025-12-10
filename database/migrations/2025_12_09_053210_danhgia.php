<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('danh_gia', function (Blueprint $table) {
    $table->string('MaDG', 10)->primary();
    $table->string('MaKH', 10);
    $table->string('MaSP', 10);

    $table->string('NoiDung', 1000);
    $table->date('NgayDG');

    $table->timestamps();

    $table->foreign('MaKH')->references('MaKH')->on('khach_hang')->onDelete('cascade');
    $table->foreign('MaSP')->references('MaSP')->on('sanpham')->onDelete('cascade');

    $table->index('MaSP');
    $table->index('MaKH');
    $table->index('NgayDG');
});
    }

    public function down()
    {
        Schema::dropIfExists('danh_gia');
    }
};
