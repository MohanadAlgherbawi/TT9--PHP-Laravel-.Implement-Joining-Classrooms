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
        Schema::create('classwork', function (Blueprint $table) {
            
            $table->id();
            $table->string('title');
            $table->enum('type', ['assignment', 'quiz', 'question', 'material']);
            $table->text('description')->nullable();
            $table->foreignId('classroom_id')->constrained()->cascadeOnDelete();
            $table->foreignId('topic_id')->nullable()->constrained()->nullOnDelete();
            $table->foreignId('user_id')->constrained()->nullOnDelete(); // المنشئ
            $table->timestamps();
});


       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classwork');
    }
};
