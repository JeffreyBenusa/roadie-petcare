<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void {
        Schema::create('availabilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('provider_id')->constrained()->cascadeOnDelete();
            $table->date('date');
            $table->timestamps();
            
            $table->unique(['provider_id', 'date']);
        });
    }
    
    public function down(): void {
        Schema::dropIfExists('availabilities');
    }
};