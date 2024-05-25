<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class UserNotification extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "notification_id",
        "user_id",
        "message",
        "is_read",
        "read_at",
        "status",
    ];
}
