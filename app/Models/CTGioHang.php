<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CTGioHang extends Model
{
    use HasFactory;
    
    protected $table = 'chitietgiohang'; 
    protected $primaryKey = 'MaCTGH'; 
    public $incrementing = false;
    protected $keyType = 'string'; 
    protected $fillable = [
        'MaSP',
        'MaKH', 
        'SoLuong',
        'ThanhTien', 
    ];
    public $timestamps = true;

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($ctGioHang) {
            $lastCT = static::orderBy('MaCTGH', 'desc')->first();
            if ($lastCT) {
                $lastNumber = (int) substr($lastCT->MaCTGH, 2); 
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            $ctGioHang->MaCTGH = 'CT' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    // ==========================================================

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }

    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }
}