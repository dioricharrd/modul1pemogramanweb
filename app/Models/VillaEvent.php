<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VillaEvent extends Model
{
    use HasFactory;

    protected $fillable = [
        'villa_id', 
        'name', 
        'description', 
        'start_date', 
        'end_date'
    ];

    // Relasi ke Villa
    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}
