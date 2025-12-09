<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChiTietHoaDon extends Model
{
    use HasFactory;

    protected $table = 'chi_tiet_hoa_don';
    protected $primaryKey = 'MaCTHD';

    public $incrementing = false; 
    protected $keyType = 'string'; 

    protected $fillable = [
        'MaCTHD', 'MaSP', 'MaHD', 'SoLuong', 'DonGia', 'ThanhTien'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($chiTiet) {
            if (empty($chiTiet->MaCTHD)) {
                $lastChiTiet = static::orderBy('MaCTHD', 'desc')->first();
                
                if ($lastChiTiet && $lastChiTiet->MaCTHD) {
                    $lastNumber = (int) substr($lastChiTiet->MaCTHD, 4); 
                    $newNumber = $lastNumber + 1;
                } else {
                    $newNumber = 1;
                }

                $chiTiet->MaCTHD = 'CTHD' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
            }
        });
    }

    public function sanPham()
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }

    public function hoaDon()
    {
        return $this->belongsTo(HoaDon::class, 'MaHD', 'MaHD');
    }
}