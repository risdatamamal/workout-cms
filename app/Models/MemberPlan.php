<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MemberPlan extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'price_monthly',
        'duration',
        'is_active',
    ];

    protected $casts = [
        'deleted_at'        => 'datetime:Y/m/d H:m',
        'created_at'        => 'datetime:Y/m/d H:m',
        'updated_at'        => 'datetime:Y/m/d H:m'
    ];
}
