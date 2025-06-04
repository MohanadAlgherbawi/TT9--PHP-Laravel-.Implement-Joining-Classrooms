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
        Schema::create('classrooms', function (Blueprint $table) {
                   $table->id();// id BIGINY unsigned auto_increment primary key
            $table->string('name',255);// name VARCHAR(255) not null not case sensitive
            $table->string('code',10)->unique();
            $table->string('section' )->nullable();
            $table->string('subject')->nullable();
            $table->string('room')->nullable();
            $table->string('cover_image_path')->nullable();// iitavef binary case sensitive
            $table->string('theme')->nullable();
            $table->foreignId('user_id')
            ->nullable()
            ->constrained('users','id')//relationship with users table
            ->nullOnDelete();// BIGINT unsigned not null foreign key references users(id) on delete cascade
            $table->enum('status', ['active', 'archived'])
                ->default('active');// status ENUM('active', 'archived') not null default 'active'
            $table->timestamps();// created at + updated at timestamps  
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('classrooms');
    }
};
