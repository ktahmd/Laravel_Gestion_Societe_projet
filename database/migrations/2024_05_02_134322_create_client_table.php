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
        Schema::create('client', function (Blueprint $table) {
            $table->id();
            $table->string('nom', 255);
            $table->string('email', 255);
            $table->string('telephone', 20);
            $table->string('adresse', 255);
            $table->timestamp('created_at')->default(now());
            $table->timestamp('updated_at')->nullable();
       
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('client');
    }
};
