<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExperienceTrainer extends Model
{
    use HasFactory;

    protected $table = 'experience_trainers';

    protected $fillable = [
        'trainer_id',
        'year',
        'company',
        'position'
    ];

    protected $casts = [
        'created_at'      => 'datetime:d/m/Y H:m',
        'updated_at'      => 'datetime:d/m/Y H:m'
    ];

    public function trainer()
    {
        return $this->belongsTo(Trainer::class, 'trainer_id', 'id');
    }
}
