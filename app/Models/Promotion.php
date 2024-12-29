<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    protected $fillable = ['villa_id', 'title', 'description', 'discount_percentage', 'valid_from', 'valid_until'];

    // Relasi ke model Villa
    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}
