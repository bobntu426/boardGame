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
            $table->integer('belief')->default(0);
            $table->integer('order')->nullable();
            $table->integer('nextOrder')->nullable();
            $table->integer('sideBar')->nullable();
            $table->integer('extraProduction')->nullable();
            $table->integer('extraHarvest')->nullable();
            $table->integer('extraGreenPoint')->nullable();
            $table->integer('extraBluePoint')->nullable();
            $table->integer('extraYellowPoint')->nullable();
            $table->integer('extraPurplePoint')->nullable();
            $table->string('needAction')->default('wait')->comment('玩家需要做甚麼行動，顯示訊息用');
            $table->string('redPillar')->default(value: 'hand');
            $table->string('blackPillar')->default('hand');
            $table->string('whitePillar')->default('hand');
            $table->string('normalPillar')->default('hand');
            $table->string('color')->nullable();
            $table->boolean('punish1')->default(false);
            $table->boolean('punish2')->default(false);
            $table->boolean('punish3')->default(false);
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
