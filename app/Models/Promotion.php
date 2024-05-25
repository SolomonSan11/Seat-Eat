<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Promotion extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "name",
        "code",
        "specific_count",
        "normal_count",
        "expire_code",
        "benefits",
        "discount",
        "user_usage_duration",
        "expire_period",
        "status",
        "created_by",
        "updated_by"
    ];
}
