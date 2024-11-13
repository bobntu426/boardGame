<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
class importCards extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-cards';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import your cards';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        for( $i = 1; $i <= 24; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"green",
                'image'=>"images/card$i"
            ];
            DB::table('card_tables')->insert($data);
        }
        for( $i = 25; $i <= 48; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"blue",
                'image'=>"images/card$i"
            ];
            DB::table('card_tables')->insert($data);
        }
        for( $i = 49; $i <= 72; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"yellow",
                'image'=>"images/card$i"
            ];
            DB::table('card_tables')->insert($data);
        }
        for( $i = 73; $i <= 96; $i++ ) {
            $data = [
                'name'=>"card$i",
                'color'=>"purple",
                'image'=>"images/card$i"
            ];
            DB::table('card_tables')->insert($data);
        }
    }
    
}
