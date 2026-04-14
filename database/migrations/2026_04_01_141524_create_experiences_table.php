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
       Schema::create('experiences', function (Blueprint $table) {
    $table->id();
    $table->string('title');
    $table->string('address')->nullable();
    $table->text('content');
    $table->integer('rating')->nullable(); 
    $table->string('time_of_day')->nullable();    
    $table->string('ambiance')->nullable();       
    $table->string('activity_type')->nullable();  
    $table->string('crowd_level')->nullable();    

    $table->foreignId('user_id')->constrained()->onDelete('cascade');
    $table->foreignId('place_id')->constrained()->onDelete('cascade');
    $table->timestamps();
});
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('experiences');
    }
};