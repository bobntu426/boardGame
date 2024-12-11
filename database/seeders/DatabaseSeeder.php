<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $greenCards = config('greenCards.greenCards');
        $yellowCards = config('yellowCards.yellowCards');
        $blueCards = config('blueCards.blueCards');
        $purpleCards = config('purpleCards.purpleCards');
        DB::table('green_card_tables')->truncate();
        for( $i = 0; $i <= 23; $i++ ) {
            $imageIndex = $i+1;
            $data = [
                'name'=>$greenCards[$i]['name'],
                'color'=>"green",
                'image'=>"images/cards/green/$imageIndex".".png",
                'harvestPoint'=>$greenCards[$i]['harvestPoint'],
                'gainMoneyWhenBuy'=>$greenCards[$i]['gainMoneyWhenBuy'],
                'gainWoodWhenBuy'=>$greenCards[$i]['gainWoodWhenBuy'],
                'gainRockWhenBuy'=>$greenCards[$i]['gainRockWhenBuy'],
                'gainWorkerWhenBuy'=>$greenCards[$i]['gainWorkerWhenBuy'],
                'gainMilitaryWhenBuy'=>$greenCards[$i]['gainMilitaryWhenBuy'],
                'gainBeliefWhenBuy'=>$greenCards[$i]['gainBeliefWhenBuy'],
                'gainScoreWhenBuy'=>$greenCards[$i]['gainScoreWhenBuy'],
                'gainReelWhenBuy'=>$greenCards[$i]['gainReelWhenBuy'],
                'gainMoneyWhenUse'=>$greenCards[$i]['gainMoneyWhenUse'],
                'gainWoodWhenUse'=>$greenCards[$i]['gainWoodWhenUse'],
                'gainRockWhenUse'=>$greenCards[$i]['gainRockWhenUse'],
                'gainWorkerWhenUse'=>$greenCards[$i]['gainWorkerWhenUse'],
                'gainMilitaryWhenUse'=>$greenCards[$i]['gainMilitaryWhenUse'],
                'gainBeliefWhenUse'=>$greenCards[$i]['gainBeliefWhenUse'],
                'gainScoreWhenUse'=>$greenCards[$i]['gainScoreWhenUse'],
                'gainReelWhenUse'=>$greenCards[$i]['gainReelWhenUse'],
            ];
            
            DB::table('green_card_tables')->insert($data);
        }
        DB::table('yellow_card_tables')->truncate();
        for( $i = 0; $i <= 23; $i++ ) {
            $imageIndex = $i+25;
            $data = [
                'name'=>$yellowCards[$i]['name'],
                'color'=>"yellow",
                'image'=>"images/cards/yellow/$imageIndex".".png",
                'productionPoint'=>$yellowCards[$i]['productionPoint'],
                'costMoney'=>$yellowCards[$i]['costMoney'],
                'costWood'=>$yellowCards[$i]['costWood'],
                'costRock'=>$yellowCards[$i]['costRock'],
                'costWorker'=>$yellowCards[$i]['costWorker'],
                'gainBeliefWhenBuy'=>$yellowCards[$i]['gainBeliefWhenBuy'],
                'gainScoreWhenBuy'=>$yellowCards[$i]['gainScoreWhenBuy'],
                'gainMoneyWhenUse1'=>$yellowCards[$i]['gainMoneyWhenUse1'],
                'gainWoodWhenUse1'=>$yellowCards[$i]['gainWoodWhenUse1'],
                'gainRockWhenUse1'=>$yellowCards[$i]['gainRockWhenUse1'],
                'gainWorkerWhenUse1'=>$yellowCards[$i]['gainWorkerWhenUse1'],
                'gainBeliefWhenUse1'=>$yellowCards[$i]['gainBeliefWhenUse1'],
                'gainReelWhenUse1'=>$yellowCards[$i]['gainReelWhenUse1'],
                'gainScoreWhenUse1'=>$yellowCards[$i]['gainScoreWhenUse1'],
                'gainMilitaryWhenUse1'=>$yellowCards[$i]['gainMilitaryWhenUse1'],
                'costMoneyWhenUse1'=>$yellowCards[$i]['costMoneyWhenUse1'],
                'costWoodWhenUse1'=>$yellowCards[$i]['costWoodWhenUse1'],
                'costRockWhenUse1'=>$yellowCards[$i]['costRockWhenUse1'],
                'costWorkerWhenUse1'=>$yellowCards[$i]['costWorkerWhenUse1'],
                'costBeliefWhenUse1'=>$yellowCards[$i]['costBeliefWhenUse1'],
                'twoTrigger'=>$yellowCards[$i]['twoTrigger'],
                'chooseOneCost'=>$yellowCards[$i]['chooseOneCost'],
            ];
            if($data['twoTrigger']){
                $data['gainMoneyWhenUse2'] = $yellowCards[$i]['gainMoneyWhenUse2'];
                $data['gainWoodWhenUse2'] = $yellowCards[$i]['gainWoodWhenUse2'];
                $data['gainRockWhenUse2'] = $yellowCards[$i]['gainRockWhenUse2'];
                $data['gainScoreWhenUse2'] = $yellowCards[$i]['gainScoreWhenUse2'];
                $data['costMoneyWhenUse2'] = $yellowCards[$i]['costMoneyWhenUse2'];
                $data['costWoodWhenUse2'] = $yellowCards[$i]['costWoodWhenUse2'];
                $data['costRockWhenUse2'] = $yellowCards[$i]['costRockWhenUse2'];
            }
            if(isset($yellowCards[$i]['functionColor'])){
                $data['functionColor'] = $yellowCards[$i]['functionColor'];
            }
            DB::table('yellow_card_tables')->insert($data);
        }
        DB::table('blue_card_tables')->truncate();
        for( $i = 0; $i <= 23; $i++ ) {
            $imageIndex = $i+49;
            $data = [
                'name'=>$blueCards[$i]['name'],
                'color'=>"blue",
                'image'=>"images/cards/blue/$imageIndex".".png",
                'function'=>$blueCards[$i]['function'],
                'point'=>$blueCards[$i]['point'],
                'costMoney'=>$blueCards[$i]['costMoney'],
                'gainMilitaryWhenBuy'=>$blueCards[$i]['gainMilitaryWhenBuy'],
                'gainBeliefWhenBuy'=>$blueCards[$i]['gainBeliefWhenBuy'],
                'gainScoreWhenBuy'=>$blueCards[$i]['gainScoreWhenBuy'],
                'gainReelWhenBuy'=>$blueCards[$i]['gainReelWhenBuy'],
            ];
            if(isset($blueCards[$i]['functionTarget'])){
                $data['functionTarget'] = $blueCards[$i]['functionTarget'];
            }
            DB::table('blue_card_tables')->insert($data);
        }
        DB::table('purple_card_tables')->truncate();
        for( $i = 0; $i <= 23; $i++ ) {
            $imageIndex = $i+73;
            $data = [
                'name'=>$purpleCards[$i]['name'],
                'color'=>"purple",
                'image'=>"images/cards/purple/$imageIndex".".png",
                'point'=>$purpleCards[$i]['point'],
                'costMoney'=>$purpleCards[$i]['costMoney'],
                'costWood'=>$purpleCards[$i]['costWood'],
                'costRock'=>$purpleCards[$i]['costRock'],
                'costWorker'=>$purpleCards[$i]['costWorker'],
                'costMilitary'=>$purpleCards[$i]['costMilitary'],
                'needMilitary'=>$purpleCards[$i]['needMilitary'],
                'gainMoneyWhenBuy'=>$purpleCards[$i]['gainMoneyWhenBuy'],
                'gainWoodWhenBuy'=>$purpleCards[$i]['gainWoodWhenBuy'],
                'gainRockWhenBuy'=>$purpleCards[$i]['gainRockWhenBuy'],
                'gainWorkerWhenBuy'=>$purpleCards[$i]['gainWorkerWhenBuy'],
                'gainMilitaryWhenBuy'=>$purpleCards[$i]['gainMilitaryWhenBuy'],
                'gainBeliefWhenBuy'=>$purpleCards[$i]['gainBeliefWhenBuy'],
                'gainScoreWhenBuy'=>$purpleCards[$i]['gainScoreWhenBuy'],
                'gainReelWhenBuy'=>$purpleCards[$i]['gainReelWhenBuy'],
                'gainScoreEnd'=>$purpleCards[$i]['gainScoreEnd'],
            ];
            if(isset($purpleCards[$i]['function'])){
                $data['function'] = $purpleCards[$i]['function'];
            }
            DB::table('purple_card_tables')->insert($data);
        }

        
        $hashedPassword = Hash::make(12);
        $data = [
            'name'=>"12",
            'email'=>"12@gmail.com",
            'password'=>$hashedPassword
        ];
        User::updateOrCreate(['name'=>"12"],$data);
        $hashedPassword = Hash::make(123);
        $data = [
            'name'=>"123",
            'email'=>"123@gmail.com",
            'password'=>$hashedPassword
        ];
        User::updateOrCreate(['name'=>"123"],$data);
        $hashedPassword = Hash::make(1234);
        $data = [
            'name'=>"1234",
            'email'=>"1234@gmail.com",
            'password'=>$hashedPassword
        ];
        User::updateOrCreate(['name'=>"1234"],$data);
    }
}
