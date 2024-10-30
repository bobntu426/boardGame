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
        Schema::table("card", function (Blueprint $table) {
            $table->integer('gainMoneyWhenBuy')->default(0)->change();
            $table->integer('gainRockWhenBuy')->default(0)->change();
            $table->integer('gainWoodWhenBuy')->default(0)->change();
            $table->integer('gainWorkerWhenBuy')->default(0)->change();
            $table->integer('gainMoneyWhenUse')->default(0)->change();
            $table->integer('gainRockWhenUse')->default(0)->change();
            $table->integer('gainWorkerWhenUse')->default(0)->change();
            $table->integer('gainWoodWhenUse')->default(0)->change();
            $table->integer('costMoney')->default(0)->change();
            $table->integer('costWood')->default(0)->change();
            $table->integer('costRock')->default(0)->change();
            $table->integer('costWorker')->default(0)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table("card", function (Blueprint $table) {
            $table->dropColumn('gainMoneyWhenBuy');
            $table->dropColumn('gainRockWhenBuy');
            $table->dropColumn('gainWoodWhenBuy');
            $table->dropColumn('gainWorkerWhenBuy');
            $table->dropColumn('gainMoneyWhenUse');
            $table->dropColumn('gainRockWhenUse');
            $table->dropColumn('gainWorkerWhenUse');
            $table->dropColumn('gainWoodWhenUse');
        });
    }
};
