<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $table = 'members';

    protected $fillable = [
        'user_id',
        'member_plan_id',
        'enrolled_date',
        'expired_date',
    ];

    protected $casts = [
        'enrolled_date'     => 'date',
        'expired_date'      => 'date',
        'created_at'        => 'datetime:d/m/Y H:m',
        'updated_at'        => 'datetime:d/m/Y H:m'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function member_plan()
    {
        return $this->hasOne(MemberPlan::class, 'member_plan_id', 'id');
    }
}
