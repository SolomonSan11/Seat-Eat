<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users');
            $table->foreignId('menu_id')->nullable()->constrained('menus');
            $table->foreignId('restaurant_id')->nullable()->constrained('restaurants');
            $table->foreignId('table_id')->nullable()->constrained('tables');
            $table->foreignId('parking_slot_id')->nullable()->constrained('parking_slots');
            $table->string('ticket_number')->nullable();
            $table->string('customer_total')->nullable();
            $table->dateTime('date_time')->nullable();
            $table->boolean('is_confirmed')->nullable();
            $table->boolean('is_cancel')->nullable();
            $table->boolean('is_changed')->nullable();
            $table->dateTime('change_date_time')->nullable();
            $table->string('payment_type')->nullable();
            $table->string('payment_category')->nullable();
            $table->string('special_request')->nullable();
            $table->string('amount')->nullable();
            $table->string('total_amount')->nullable();
            $table->timestamp('check_in')->nullable();
            $table->timestamp('check_out')->nullable();
            $table->integer('status')->default(1);
            $table->tinyInteger('created_by')->nullable();
            $table->tinyInteger('updated_by')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};
