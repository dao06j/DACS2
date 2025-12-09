<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;

class KhachHang extends Authenticatable
{
    use HasFactory;
    protected $table = 'khach_hang';
    protected $primaryKey = 'MaKH';
    protected $keyType = 'string';
    public $incrementing = false;
    public $timestamps = true;
    protected $password = 'MatKhau'; 
    protected $fillable = [
        'Email',
        'MatKhau',
        'HoTen',
        'Sdt',
        'DiaChi',
    ];
    protected $hidden = [
        'MatKhau',
        'remember_token',
    ];
    protected $casts = [
        'MaKH' => 'string',
        'Email' => 'string',
        'MatKhau' => 'string',
        'HoTen' => 'string',
        'Sdt' => 'string',
        'DiaChi' => 'string',
    ];
    protected static function boot()
    {
        parent::boot();
        static::creating(function ($khachHang) {
            $lastKhachHang = static::orderBy('MaKH', 'desc')->first();
            if ($lastKhachHang && $lastKhachHang->MaKH) {
                $lastNumber = (int) substr($lastKhachHang->MaKH, 2); 
                $newNumber = $lastNumber + 1;
            } else {
                $newNumber = 1; 
            }
            $khachHang->MaKH = 'KH' . str_pad($newNumber, 3, '0', STR_PAD_LEFT);
        });
    }

    public static function validationRules()
    {
        return [
            'Email' => 'required|email|max:255|unique:khach_hang,Email',
            'MatKhau' => 'required|string|min:6|max:255',
            'HoTen' => 'required|string|max:255',
            'Sdt' => 'nullable|string|max:15',
            'DiaChi' => 'nullable|string|max:500',
        ];
    }

    public function setMatKhauAttribute($value)
    {
        $this->attributes['MatKhau'] = bcrypt($value);
    }

    public function getRememberTokenName()
    {
        return 'remember_token';
    }

    public function getAuthIdentifierName()
    {
        return 'MaKH';
    }

    public function getAuthIdentifier()
    {
        return $this->MaKH;
    }
    public function getAuthPassword()
    {
        return $this->MatKhau;
    }

    public function danhGia(): HasMany
    {
        return $this->hasMany(DanhGia::class, 'MaKH', 'MaKH');
    }

    public function hasReviewed($maSP): bool
    {
        return $this->danhGia()->where('MaSP', $maSP)->exists();
    }

}