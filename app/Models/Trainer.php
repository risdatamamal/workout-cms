<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trainer extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'contract',
        'experience',
        'speciality',
        'certification',
        'contracted_at'
    ];

    protected $casts = [
        'experience'      => 'array',
        'speciality'      => 'array',
        'certification'   => 'array',
        'contracted_at'   => 'date',
        'created_at'      => 'datetime:d/m/Y H:m',
        'updated_at'      => 'datetime:d/m/Y H:m'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
