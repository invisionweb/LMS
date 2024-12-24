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
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->longText('description');
            $table->tinyText('thumbnail');
            $table->float('rating')->nullable();
            $table->float('price')->nullable();
            $table->unsignedInteger('subject_id');
            //$table->json('chapters');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('courses');
    }
};
