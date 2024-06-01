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
        Schema::create('service_requests', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('property_id');
            $table->unsignedBigInteger('company_id');
            $table->text('description');
            $table->enum('status', ['pending', 'in_progress', 'completed', 'cancelled']);
            $table->timestamps();

            // Relacion con la tabla propertyies
            $table->foreign('property_id')->references('id')->on('properties')->onDelete('cascade');
            //Relacion con la table service_companies
            $table->foreign('company_id')->references('id')->on('service_companies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('service_requests');
    }
};
