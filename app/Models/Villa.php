<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Villa extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price',
        'capacity',
    ];

    // Accessor untuk memformat harga menjadi format rupiah
    public function getPriceFormattedAttribute()
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    // Accessor untuk membuat nama selalu Title Case
    public function getNameAttribute($value)
    {
        return ucwords($value);
    }
    
    public function facilities()
    {
        return $this->hasMany(Facility::class);
    }

    public function promotions()
    {
        return $this->hasMany(Promotion::class);
    }

    public function galleries()
    {
        return $this->hasMany(Gallery::class);
    }
}
