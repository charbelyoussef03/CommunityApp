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
        Schema::create('_vote', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('UserId');
            $table->unsignedBigInteger('CommentId')->nullable();
            $table->unsignedBigInteger('PostId')->nullable();
            $table->boolean('IsUpvote');
            $table->timestamps();
            $table->foreign('CommentId')->references('id')->on('_comment')->onDelete('cascade');
            $table->foreign('UserId')->references('id')->on('_person')->onDelete('cascade');
            $table->foreign('PostId')->references('id')->on('_post')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_vote');
    }
};
