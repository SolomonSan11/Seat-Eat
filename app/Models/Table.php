<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Table extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "restaurant_id",
        "name",
        "type",
        "status",
        "created_by",
        "updated_by"
    ];
}
