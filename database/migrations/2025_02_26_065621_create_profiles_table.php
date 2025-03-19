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
        Schema::create('profiles', function (Blueprint $table): void {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade'); // One-to-one relationship
            $table->string('profile_image')->nullable();
            $table->string('full_name');
            $table->text('about')->nullable();
            $table->string('company')->nullable();
            $table->string('position')->nullable();
            $table->string('country', 100)->nullable();
            $table->string('address')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('email')->nullable()->unique(); 
            $table->string('twitter_url')->nullable(); 
            $table->string('facebook_url')->nullable();
            $table->string('instagram_url')->nullable();
            $table->string('linkedin_url')->nullable();
            $table->timestamps();
        });
        
    }


    public function down(): void
    {
        Schema::dropIfExists('profiles');
    }
};
