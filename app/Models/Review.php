<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = [
        'villa_id',
        'customer_name',
        'review',
        'rating',
    ];

    // Relasi dengan Villa
    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}
