<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RedeemReward extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "reward_id",
        "reward_category_id",
        "name",
        "point",
        "status",
        "created_by",
        "updated_by"
    ];
}
