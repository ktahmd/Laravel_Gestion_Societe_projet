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
        Schema::create('factures', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('commandes_id')->unsigned();
            $table->integer('client_id')->unsigned();
            $table->integer('produit_id')->unsigned();
            
            $table->timestamps();
            
            $table->foreign('produit_id')->references('id')->on('produit')->onDelete('cascade');
            $table->foreign('produit_id')->references('id')->on('produit')->onDelete('cascade');
            $table->foreign('client_id')->references('id')->on('client')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('factures');
    }
};
