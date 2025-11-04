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
        Schema::create('galleries', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('description')->nullable();
            $table->string('original_path');  // المسار الأصلي
            $table->string('medium_path')->nullable();  // صورة متوسطة
            $table->string('thumbnail_path')->nullable();  // صورة مصغرة
            $table->string('filename');
            $table->unsignedBigInteger('size'); // الحجم بالبايت
            $table->string('mime_type');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('galleries');
    }
};
