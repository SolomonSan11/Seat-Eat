<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Loyalty extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "name",
        "status",
        "created_by",
        "updated_by"
    ];
}
