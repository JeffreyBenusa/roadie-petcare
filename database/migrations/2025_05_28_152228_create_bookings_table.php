<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('bookings', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->cascadeOnDelete(); // Who made the booking
            $table->foreignId('provider_id')->constrained('users')->cascadeOnDelete(); // Who was booked
            $table->foreignId('service_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->enum('status', ['pending', 'accepted', 'rejected'])->default('pending');
            $table->timestamps();
            
            $table->unique(['provider_id', 'service_id', 'date']); // Prevent duplicate bookings
        });
    }
    
    public function down(): void
    {
        Schema::dropIfExists('bookings');
    }
};