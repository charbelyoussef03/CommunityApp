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
        Schema::create('_report', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('ReporterId');
            $table->unsignedBigInteger('ReportedId');
            $table->string('Reason');
            $table->string('Status');
            $table->timestamps();
            $table->foreign('ReporterId')->references('id')->on('_person')->onDelete('cascade');
            $table->foreign('ReportedId')->references('id')->on('_person')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('_report');
    }
};
