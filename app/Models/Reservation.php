<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    /**
     * Kolom yang dapat diisi secara massal.
     */
    protected $fillable = [
        'villa_id',
        'customer_name',
        'check_in',
        'check_out',
        'number_of_guests',
    ];

    /**
     * Relasi ke model Villa.
     */
    public function villa()
    {
        return $this->belongsTo(Villa::class);
    }
}
