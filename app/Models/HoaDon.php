<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HoaDon extends Model
{
    use HasFactory;

    protected $table = 'hoa_don';
    protected $primaryKey = 'MaHD';

    public $incrementing = false; 
    protected $keyType = 'string';

    protected $fillable = [
        'MaHD', 'MaKH', 'TongTien', 'NgayThanhToan', 'TrangThai'
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($hoaDon) {
            
            $lastHoaDon = static::orderBy('MaHD', 'desc')->first();
            
            if ($lastHoaDon && $lastHoaDon->MaHD) {
                $lastNumber = (int) substr($lastHoaDon->MaHD, 2); 
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1;
            }
            $hoaDon->MaHD = 'HD' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }
    public function khachHang()
    {
        return $this->belongsTo(KhachHang::class, 'MaKH', 'MaKH');
    }
}