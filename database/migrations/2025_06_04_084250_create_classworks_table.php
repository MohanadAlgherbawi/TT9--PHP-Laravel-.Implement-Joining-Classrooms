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
        Schema::create('classworks', function (Blueprint $table) {
            
            $table->id();
            $table->string('title');
            $table->enum('type', ['assignment', 'question', 'material']);
            $table->text('description')
            ->nullable();// 4k (text) logtext(4giga)
            $table->foreignId('classroom_id')
            ->constrained()->cascadeOnDelete();
            $table->enum('status',['published','draft'])
            ->default('published');
            $table->timestamp('published_at')
            ->nullable();
            $table->foreignId('user_id')
            ->nullable()->constrained()->nullOnDelete(); // المنشئ
            $table->foreignId('topic_id')
            ->nullable()
            ->constrained()
            ->nullOnDelete();

            $table->json('options')
            ->nullable();
            $table->timestamps();
});


       
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classworks');
    }
};
