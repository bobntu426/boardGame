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
        Schema::create("card_tables", function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(0);
            $table->string('image')->default(0);
            $table->string('color')->default(0);
            $table->string('costMoney')->default(0);
            $table->string('costWood')->default(0);
            $table->string('costRock')->default(0);
            $table->string('costWorker')->default(0);
            $table->integer('gainMoneyWhenBuy')->default(0);
            $table->integer('gainWoodWhenBuy')->default(0);
            $table->integer('gainRockWhenBuy')->default(0);
            $table->integer('gainWorkerWhenBuy')->default(0);
            $table->integer('gainMoneyWhenUse')->default(0);
            $table->integer('gainWoodWhenUse')->default(0);
            $table->integer('gainRockWhenUse')->default(0);
            $table->integer('gainWorkerWhenUse')->default(0);
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_tables');
    }
};
