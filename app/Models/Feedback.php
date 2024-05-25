<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Feedback extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "restaurant_id",
        "user_id",
        "reason",
        "status",
        "created_by",
        "updated_by"
    ];
}
