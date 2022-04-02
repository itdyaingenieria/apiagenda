<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;

    /**
     * Override fillable property data.
     *
     * @var array
     */
    protected $fillable = [
        'asunto', 'fecha_hora', 'estado', 'state_id', 'client_id'
    ];
}
