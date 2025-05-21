<?php

# Local Models
use App\Models\User;
use App\Models\Job;

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
        Schema::create('reviews', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(Job::class)->cascadeOnDelete()->unique()->nullable();
            $table->foreignIdFor( User::class, 'provider_id')->cascadeOnDelete();
            $table->string('title');
            $table->text('body');
            $table->integer('rating');
            $table->timestamps();
            
            $table->unique(['job_id', 'provider_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('reviews');
    }
};
