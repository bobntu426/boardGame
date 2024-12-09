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
        Schema::create('temp_storages', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('player_id');
            $table->string('pillarColor')->nullable();
            $table->integer('money')->default(0);
            $table->integer('worker')->default(0);
            $table->integer('rock')->default(0);
            $table->integer('wood')->default(0);
            $table->integer('score')->default(0);
            $table->integer('military')->default(0);
            $table->integer('belief')->default(0);
            $table->integer('nextOrder')->nullable();
            $table->string('action')->nullable();
            $table->foreignId('table_id')->nullable()->constrained()->onDelete('cascade');
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('temp_storages');
    }
};
