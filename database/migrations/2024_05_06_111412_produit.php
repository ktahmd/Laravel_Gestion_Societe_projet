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
            Schema::create('commandes', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('client_id')->unsigned();;
                $table->date('date_commande');
                $table->timestamps();
    
                $table->foreign('client_id')->references('id')->on('clients')->onDelete('cascade');
            });
    
        }
    
        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('commandes');
        }
    };
    
    
    

