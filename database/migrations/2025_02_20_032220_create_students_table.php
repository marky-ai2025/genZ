<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->string('lastname', 55);
            $table->string('firstname', 55);
            $table->string('middlename', 55);
            $table->string('gender', 55);
            $table->date('birthday'); // ✅ Changed from string to DATE
            $table->string('address', 255);
            $table->string('school', 255);
            $table->string('course', 255);
            $table->string('program', 55);
            $table->string('civilstatus', 55);
            $table->string('religion', 55);
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students');
    }
};
