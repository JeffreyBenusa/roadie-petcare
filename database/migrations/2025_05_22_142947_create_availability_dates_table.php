<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('availability_dates', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete();
            $table->foreignId('service_type_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->unsignedTinyInteger('max_pets')->default(1);
            $table->unsignedTinyInteger('booked_pets')->default(0);
            $table->timestamps();
            
            $table->unique(['user_id', 'service_type_id', 'date'], 'unique_availability');
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('availability_dates');
    }
};
