<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RewardRedeem extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "reward_id",
        "redeem_id",
        "status",
        "created_by",
        "updated_by"
    ];
}
