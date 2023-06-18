<?php

use App\Models\User;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('doctors', function (Blueprint $table) {
            $table->id();
            $table->string('category')->nullable();
            $table->unsignedInteger('experience')->nullable();
            $table->unsignedInteger('patients')->nullable();
            $table->string('status')->nullable();
            $table->longText('bio_data')->nullable();
            $table->timestamps();

            $table->foreignIdFor(User::class)->unique()->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('doctors');
    }
};
