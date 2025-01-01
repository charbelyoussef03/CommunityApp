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
        Schema::create('_person', function (Blueprint $table) {
            $table->id();
            $table->string('Name');
            $table->string('LastName');
            $table->string('Email')->unique();
            $table->string('PassWord');
            $table->string('DateOfBirth');
            $table->boolean('IsBanned');
            $table->timestamps();
        });
    }
    
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_person');
    }
};
