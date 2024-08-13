<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Speciality extends Model
{
    use HasFactory;

    protected $table = 'specialities';

    protected $fillable = [
        'name',
        'is_active',
    ];

    protected $casts = [
        'created_at'      => 'datetime:d/m/Y H:m',
        'updated_at'      => 'datetime:d/m/Y H:m'
    ];
}
