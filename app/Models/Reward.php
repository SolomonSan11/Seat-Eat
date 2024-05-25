<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Reward extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "reward_category_id",
        "name",
        "point",
        "description",
        "status",
        "created_by",
        "updated_by"
    ];
}
