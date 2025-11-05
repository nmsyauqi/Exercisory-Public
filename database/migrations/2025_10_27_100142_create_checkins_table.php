<?php
// VERSI B (DIREKOMENDASIKAN)
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
        Schema::create('checkins', function (Blueprint $table) {
            $table->id(); 
            
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            
            $table->foreignId('task_id')->constrained('tasks')->onDelete('cascade');
            
            $table->timestamp('checked_at')->nullable();
            
            $table->date('date'); 
            
            $table->timestamps();


            $table->unique(['user_id', 'task_id', 'date']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('checkins');
    }
};