<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Carbon\Carbon;

class DanhGia extends Model
{
    protected $table = 'danh_gia';
    protected $primaryKey = 'MaDG';
    public $incrementing = false; 
    protected $keyType = 'string';
    
    protected $fillable = [
        'MaDG',
        'MaKH',
        'MaSP',
        'NoiDung',
        'NgayDG'
    ];

    protected $casts = [
        'NgayDG' => 'date',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($danhGia) {
            $lastDanhGia = static::orderBy('MaDG', 'desc')->first();
            
            if ($lastDanhGia && $lastDanhGia->MaDG) {
                $lastNumber = (int) substr($lastDanhGia->MaDG, 2); 
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            
            $danhGia->MaDG = 'DG' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    public function khachHang(): BelongsTo
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }

    public function sanPham(): BelongsTo
    {
        return $this->belongsTo(SanPham::class, 'MaSP', 'MaSP');
    }

    public function getFormattedDateAttribute(): string
    {
        return Carbon::parse($this->NgayDG)->format('d/m/Y');
    }

    public function scopeBySanPham($query, $maSP)
    {
        return $query->where('MaSP', $maSP)->orderBy('NgayDG', 'desc');
    }

    public function scopeByKhachHang($query, $maKH)
    {
        return $query->where('MaKH', $maKH)->orderBy('NgayDG', 'desc');
    }
}