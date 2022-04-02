<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * Override fillable property data.
     *
     * @var array
     */
    protected $fillable = [
        'nombre', 'cedula', 'fecha_nacimiento', 'user_id'
    ];
}
