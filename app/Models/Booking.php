<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Booking extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = [
        "user_id",
        "menu_id",
        "restaurant_id",
        "table_id",
        "parking_slot_id",
        "ticket_number",
        "customer_total",
        "date_time",
        "is_confirmed",
        "is_canceled",
        "is_changed",
        "change_datetime",
        "payment_type",
        "payment_category",
        "special_request",
        "amount",
        "total_amount",
        "check_in",
        "check_out",
        "status",
        "created_by",
        "updated_by"
    ];
}
