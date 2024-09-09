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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('cart_id');
            $table->foreignId('created_by_user_id')->constrained('users')->onUpdate('cascade')->onDelete('restrict');
            $table->timestamps();
            $table->string('address');
            $table->string('city');
            $table->string('name');
            $table->string('province');
            $table->string('lastname');
            $table->string('phone');
            $table->string('email');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
