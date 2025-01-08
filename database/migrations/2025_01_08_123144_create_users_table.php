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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('full_name');
            $table->string('email')->unique();
            $table->string('phone')->unique();
            $table->string('user_name')->unique();
            $table->string('password');
            $table->string('employee_id'); // Employee ID for each user
            $table->enum('role', ['super_admin', 'admin', 'gatekeeper']);
            $table->string('created_by'); // Name of the user who created this record
            $table->unsignedBigInteger('company_id'); // Foreign key to companies table
            $table->unsignedBigInteger('parent_id')->nullable(); // Foreign key to parent user
            $table->timestamps();
        
            // Foreign Key Constraints
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('cascade');
            $table->foreign('parent_id')->references('id')->on('users')->onDelete('set null');
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
