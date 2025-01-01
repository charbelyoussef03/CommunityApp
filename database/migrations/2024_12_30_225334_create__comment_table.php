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
        Schema::create('_comment', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('PostId');
            $table->unsignedBigInteger('UserId');
            $table->text('Content');
            $table->integer('LikesCount');
            $table->boolean('IsFlagged');
            $table->timestamps();
            $table->foreign('PostId')->references('id')->on('_post')->onDelete('cascade');
            $table->foreign('UserId')->references('id')->on('_person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_comment');
    }
};
