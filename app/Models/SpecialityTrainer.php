<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpecialityTrainer extends Model
{
    use HasFactory;

    protected $table = 'speciality_trainers';

    protected $fillable = [
        'trainer_id',
        'speciality_id'
    ];

    protected $casts = [
        'created_at'      => 'datetime:d/m/Y H:m',
        'updated_at'      => 'datetime:d/m/Y H:m'
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }

    public function speciality()
    {
        return $this->belongsTo(Speciality::class, 'speciality_id', 'id');
    }
}
