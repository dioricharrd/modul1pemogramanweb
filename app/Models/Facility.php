<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Facility extends Model
{
    use HasFactory;

    protected $fillable = ['villa_id', 'name', 'description'];

    // Relasi ke model Villa
    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}
