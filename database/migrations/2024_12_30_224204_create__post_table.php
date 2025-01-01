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
        Schema::create('_post', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('AuthorId');
            $table->text('Title');
            $table->integer('ViewsCount');
            $table->integer('LikesCount');
            $table->text('Category');
            $table->boolean('IsFlagged');
            $table->boolean('IsApproved');
            $table->text('Content');
            $table->string('PictureUrl');
            $table->timestamps();
            $table->foreign('AuthorId')->references('id')->on('_person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_post');
    }
};
