<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CertificationTrainer extends Model
{
    use HasFactory;

    protected $table = 'certification_trainers';

    protected $fillable = [
        'trainer_id',
        'name',
        'code_name'
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
