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
        Schema::create('_admin', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserId');
            $table->text('AccessLevel');
            $table->timestamps();
            $table->foreign('UserId')->references('id')->on('_person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_admin');
    }
};
