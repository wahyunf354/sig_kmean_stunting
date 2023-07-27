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
        Schema::create('kmeans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stunting_id');
            $table->unsignedBigInteger('cluster_id')->nullable();

            $table->foreign('stunting_id')->references('id')->on('stuntings');
            $table->foreign('cluster_id')->references('id')->on('clusters');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kmeans');
    }
};
