<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class SanPham extends Model
{

    protected $table = 'sanpham'; 
    protected $primaryKey = 'MaSP';
    protected $keyType = 'string'; 
    public $incrementing = false;
    protected $fillable = [
        'TenSP',
        'MoTa',
        'LoaiSP',
        'DonGia',
        'HinhAnh',
        'SLTonKho',
        'SLDaBan',
        'TrangThai', 
    ];
    protected $casts = [
        'DonGia' => 'float',
        'SLTonKho' => 'integer',
        'SLDaBan' => 'integer',
    ];

protected static function boot()
    {
        parent::boot();
        static::creating(function ($sanPham) {
            $lastSanPham = static::orderBy('MaSP', 'desc')->first();
            if ($lastSanPham) {
                $lastNumber = (int) substr($lastSanPham->MaSP, 2); 
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1; 
            }

            $sanPham->MaSP = 'SP' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }

     public function getRouteKeyName()
    {
        return 'MaSP'; 
    }

        public function danhGia(): HasMany
    {
        return $this->hasMany(DanhGia::class, 'MaSP', 'MaSP');
    }

    public function getTotalReviewsAttribute(): int
    {
        return $this->danhGia()->count();
    }

}
