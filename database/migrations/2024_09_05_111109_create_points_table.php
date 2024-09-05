<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePointsTable extends Migration
{
    public function up()
    {
        Schema::create('points', function (Blueprint $table) {
            $table->string('id')->unique();
            $table->string('address');
            $table->string('city');
            $table->string('province');
            $table->decimal('latitude', 10, 7);
            $table->decimal('longitude', 10, 7);
            $table->string('location_type')->nullable();
            $table->string('opening_hours')->nullable();
            $table->json('functions')->nullable();
            $table->foreignId('user_id')->constrained()->onUpdate('CASCADE')->onDelete('CASCADE');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('points');
    }
}

