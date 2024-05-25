<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Transaction extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "booking_id",
        "payment_id",
        "book_date_time",
        "amount",
        "transaction_date",
        "status",
        "created_by",
        "updated_by"
    ];
}
