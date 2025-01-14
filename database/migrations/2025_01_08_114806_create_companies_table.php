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
        Schema::create('companies', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('email')->unique();
            $table->string('phone')->nullable();
            $table->text('address');
            $table->string('logo')->nullable();
            $table->string('website')->nullable();
            $table->enum('company_type', ['private', 'public', 'non-profit'])->default('private');
            $table->string('gst_number')->nullable();
            $table->string('industry_type')->nullable();
            $table->string('registration_number')->nullable();
            $table->date('founded_date')->nullable();
            $table->integer('number_of_employees')->nullable();
            $table->boolean('status')->default(1);
            $table->timestamps();
        });
        
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('companies');
    }
};
