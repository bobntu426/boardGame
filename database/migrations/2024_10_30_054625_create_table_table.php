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
        Schema::create('tables', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->string('state')->default('wait');
            $table->integer('playerNum')->default(2);
            $table->integer('score')->default(0);
            $table->integer('military')->default(0);
            $table->integer('belief')->default(1);
            $table->integer('round')->default(1);
            $table->integer('redDice')->default(1);
            $table->integer('blackDice')->default(1);
            $table->integer('whiteDice')->default(1);
            $table->integer('punish1')->default(true);
            $table->integer('punish2')->default(true);
            $table->integer('punish3')->default(true);
            
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tables');
    }
};
