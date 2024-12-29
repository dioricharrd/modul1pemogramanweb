<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gallery extends Model
{
    use HasFactory;

    protected $fillable = ['villa_id', 'image_path', 'caption'];

    // Relasi ke model Villa
    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}
