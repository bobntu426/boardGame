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
        for( $i = 1; $i <= 24; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"green",
                'image'=>"images/cards/green/$i"
            ];
            DB::table('green_card_tables')->insert($data);
        }
        for( $i = 25; $i <= 48; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"yellow",
                'image'=>"images/cards/yellow/$i"
            ];
            DB::table('yellow_card_tables')->insert($data);
        }
        for( $i = 49; $i <= 72; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"blue",
                'image'=>"images/cards/blue/$i"
            ];
            DB::table('blue_card_tables')->insert($data);
        }
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
        DB::table('users')->insert($data);
        $hashedPassword = Hash::make(123);
        $data = [
            'name'=>"123",
            'email'=>"123@gmail.com",
            'password'=>$hashedPassword
        ];
        DB::table('users')->insert($data);
        $hashedPassword = Hash::make(123);
        $data = [
            'name'=>"1234",
            'email'=>"1234@gmail.com",
            'password'=>$hashedPassword
        ];
        DB::table('users')->insert($data);
    }
}
