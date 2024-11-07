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
        Schema::create('players', function (Blueprint $table) {
            $table->id();
            $table->integer('money')->default(0);
            $table->integer('worker')->default(0);
            $table->integer('rock')->default(0);
            $table->integer('wood')->default(0);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');;
            $table->foreignId('table_id')->nullable()->constrained()->onDelete('cascade');;
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {   

        Schema::dropIfExists('players');

    }
};
