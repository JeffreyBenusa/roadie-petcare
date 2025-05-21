<?php

# Local Models
use App\Models\User;
use App\Models\ServiceType;

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
        Schema::create('jobs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('body');
            $table->date('date_start')->nullable(); // Service start date
            $table->date('date_end')->nullable();   // Service end date
            $table->foreignIdFor( User::class, 'publisher_id')->cascadeOnDelete();
            $table->foreignIdFor(ServiceType::class)->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('jobs');
    }
};
