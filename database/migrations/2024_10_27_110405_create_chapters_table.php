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
        Schema::create('chapters', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('name');
            $table->longText('description');
            $table->longText('video_iframe');
            $table->tinyText('thumbnail');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('chapters');
    }
};
