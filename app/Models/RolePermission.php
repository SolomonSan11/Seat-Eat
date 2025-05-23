<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class RolePermission extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "permission_id",
        "role_id",
        "permission_level",
        "status",
        "created_by",
        "updated_by"
    ];
}
