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
        Schema::create('departments', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->boolean('isActive')->default(true);
            $table->unsignedBigInteger('manager_id'); // Foreign key column
            $table->foreign('manager_id')->references('id')->on('users')->onDelete('cascade');
            $table->dateTime('created_at')->default(now()); // Set default value to current datetime
            $table->dateTime('updated_at')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('departments');
    }
};
