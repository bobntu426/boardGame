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
            $table->integer('score')->default(0);
            $table->integer('military')->default(0);
            $table->integer('belief')->default(1);
            $table->integer('order')->nullable();
            $table->integer('sideBar')->nullable();
            $table->string('redPillar')->default(value: 'hand');
            $table->string('blackPillar')->default('hand');
            $table->string('whitePillar')->default('hand');
            $table->string('pillar')->default('hand');
            $table->string('color')->nullable();
            $table->boolean('punish1')->default(false);
            $table->boolean('punish2')->default(false);
            $table->boolean('punish3')->default(false);
            $table->boolean('turn')->default(false);
            $table->foreignId('user_id')->nullable()->constrained()->onDelete('cascade');
            $table->foreignId('table_id')->nullable()->constrained()->onDelete('cascade');
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
