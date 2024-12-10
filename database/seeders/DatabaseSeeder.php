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
        for( $i = 25; $i <= 48; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"yellow",
                'image'=>"images/cards/yellow/$i"
            ];
            
            DB::table('yellow_card_tables')->insert($data);
        }
        DB::table('blue_card_tables')->truncate();
        for( $i = 49; $i <= 72; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"blue",
                'image'=>"images/cards/blue/$i"
            ];
            
            DB::table('blue_card_tables')->insert($data);
        }
        DB::table('purple_card_tables')->truncate();
        for( $i = 73; $i <= 96; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"purple",
                'image'=>"images/cards/purple/$i"
            ];
            
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
