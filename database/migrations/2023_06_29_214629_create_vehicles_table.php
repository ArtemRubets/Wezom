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
        Schema::create('vehicles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('state_number')->unique();
            $table->string('color');
            $table->string('vin_code');
            $table->string('model');
            $table->string('brand');
            $table->year('year')->nullable();
            $table->timestamps();

            $table->fullText('name');
            $table->fullText('state_number');
            $table->fullText('vin_code');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('vehicles');
    }
};
