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
        Schema::create('redeem_rewards', function (Blueprint $table) {
            $table->id();
            $table->foreignId('reward_id')->nullable()->constrained('rewards');
            $table->foreignId('reward_category_id')->nullable()->constrained('reward_categories');
            $table->string('name')->nullable();
            $table->string('point')->nullable();
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
        Schema::dropIfExists('redeem_rewards');
    }
};
