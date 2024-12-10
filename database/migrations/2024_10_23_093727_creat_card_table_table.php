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
        Schema::create("green_card_tables", function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(0);
            $table->string('image')->default(0);
            $table->string('color')->default('green');
            $table->integer('harvestPoint')->default(0);
            $table->integer('gainMoneyWhenBuy')->default(0);
            $table->integer('gainWoodWhenBuy')->default(0);
            $table->integer('gainRockWhenBuy')->default(0);
            $table->integer('gainWorkerWhenBuy')->default(0);
            $table->integer('gainMilitaryWhenBuy')->default(0);
            $table->integer('gainBeliefWhenBuy')->default(0);
            $table->integer('gainScoreWhenBuy')->default(0);
            $table->integer('gainReelWhenBuy')->default(0);
            $table->integer('gainMoneyWhenUse')->default(0);
            $table->integer('gainWoodWhenUse')->default(0);
            $table->integer('gainRockWhenUse')->default(0);
            $table->integer('gainWorkerWhenUse')->default(0);
            $table->integer('gainMilitaryWhenUse')->default(0);
            $table->integer('gainBeliefWhenUse')->default(0);
            $table->integer('gainScoreWhenUse')->default(0);
            $table->integer('gainReelWhenUse')->default(0);
            $table->timestamps();

        });
        Schema::create("blue_card_tables", function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(0);
            $table->string('image')->default(0);
            $table->string('color')->default('blue');
            $table->string('function')->nullable()->comment('blue cards has many types of function');
            //gainDice,increasePoint

            $table->integer('point')->default(0);
            $table->string('functionTarget')->nullable();
            $table->integer('costMoney')->default(0);

            $table->integer('gainMilitaryWhenBuy')->default(0);
            $table->integer('gainBeliefWhenBuy')->default(0);
            $table->integer('gainScoreWhenBuy')->default(0);
            $table->integer('gainReelWhenBuy')->default(0);
            $table->timestamps();

        });
        
        Schema::create("yellow_card_tables", function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(0);
            $table->string('image')->default(0);
            $table->string('color')->default('yellow');
            $table->integer('productionPoint')->default(0);

            $table->string('functionColor')->nullable();
            
            $table->integer('costMoney')->default(0);
            $table->integer('costWood')->default(0);
            $table->integer('costRock')->default(0);
            $table->integer('costWorker')->default(0);
 
            $table->integer('gainBeliefWhenBuy')->default(0);
            $table->integer('gainScoreWhenBuy')->default(0);

            $table->integer('gainMoneyWhenUse1')->default(0);
            $table->integer('gainWoodWhenUse1')->default(0);
            $table->integer('gainRockWhenUse1')->default(0);
            $table->integer('gainWorkerWhenUse1')->default(0);
            $table->integer('gainBeliefWhenUse1')->default(0);
            $table->integer('gainScoreWhenUse1')->default(0);
            $table->integer('gainReelWhenUse1')->default(0);
            
            $table->integer('gainMilitaryWhenUse1')->default(0);
            $table->integer('gainMoneyWhenUse2')->nullable();
            $table->integer('gainWoodWhenUse2')->nullable();
            $table->integer('gainRockWhenUse2')->nullable();
            $table->integer('gainScoreWhenUse2')->nullable();

            
            $table->integer('costMoneyWhenUse1')->default(0);
            $table->integer('costWoodWhenUse1')->default(0);
            $table->integer('costRockWhenUse1')->default(0);
            $table->integer('costWorkerWhenUse1')->default(0);
            $table->integer('costBeliefWhenUse1')->default(0);
            $table->integer('costMoneyWhenUse2')->nullable();
            $table->integer('costWoodWhenUse2')->nullable();
            $table->integer('costRockWhenUse2')->nullable();

            $table->boolean('twoTrigger')->default(false);
            $table->boolean('chooseOneCost')->default(false);
            $table->timestamps();

        });
        Schema::create("purple_card_tables", function (Blueprint $table) {
            $table->id();
            $table->string('name')->default(0);
            $table->string('image')->default(0);
            $table->string('color')->default('purple');
            $table->string('function')->nullable();
            $table->integer('point')->default(0);
            $table->integer('costMoney')->default(0);
            $table->integer('costWood')->default(0);
            $table->integer('costRock')->default(0);
            $table->integer('costWorker')->default(0);
            $table->integer('costMilitary')->default(0);
            $table->integer('needMilitary')->default(0);
            $table->integer('gainMoneyWhenBuy')->default(0);
            $table->integer('gainWoodWhenBuy')->default(0);
            $table->integer('gainRockWhenBuy')->default(0);
            $table->integer('gainWorkerWhenBuy')->default(0);
            $table->integer('gainMilitaryWhenBuy')->default(0);
            $table->integer('gainBeliefWhenBuy')->default(0);
            $table->integer('gainScoreWhenBuy')->default(0);
            $table->integer('gainReelWhenBuy')->default(0);
            $table->integer('gainScoreEnd')->default(0);

            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('green_card_tables');
        Schema::dropIfExists('blue_card_tables');
        Schema::dropIfExists('yellow_card_tables');
        Schema::dropIfExists('purple_card_tables');
    }
};
