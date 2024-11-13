<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
class importUser extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:import-users';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'import your users';

    /**
     * Execute the console command.
     */
    public function handle()
    {
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
