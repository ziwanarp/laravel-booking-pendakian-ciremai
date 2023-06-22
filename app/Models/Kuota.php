<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kuota extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function scopeFilter($query, array $filters)
    {
        $query->when($filters['jalur'] ?? false, function ($query, $jalur) {
            return $query->where('jalur', '=', $jalur);
        });
        $query->when($filters['tanggal'] ?? false, function ($query, $tanggal) {
            return $query->where('tanggal', '=', $tanggal);
        });
        $query->when($filters['jumlah_kuota'] ?? false, function ($query, $jumlah_kuota) {
            return $query->where('jumlah_kuota', '>=', $jumlah_kuota);
        });
        $query->when($filters['bulan'] ?? false, function ($query, $bulan) {
            return $query->where('bulan', '=', $bulan);
        });
        $query->when($filters['tahun'] ?? false, function ($query, $tahun) {
            return $query->where('tahun', '=', $tahun);
        });
    }

    public function order()
    {
        return $this->hasMany(Order::class);
    }
}
