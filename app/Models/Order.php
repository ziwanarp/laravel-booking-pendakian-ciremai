<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $with = ['user', 'kuota'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function kuota()
    {
        return $this->belongsTo(Kuota::class);
    }
}
