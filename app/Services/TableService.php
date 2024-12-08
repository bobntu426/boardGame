<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Player;
use App\Models\Table;
use App\Models\TempStorage;
use Illuminate\Support\Facades\DB;

class TableService
{

    public function initGame(string $tableId)
    {
        
        $cardTables = [
            DB::table('green_card_tables')->get(),
            DB::table('yellow_card_tables')->get(),
            DB::table('blue_card_tables')->get(),
            DB::table('purple_card_tables')->get(),
        ];
        
        $data = [];
        foreach ($cardTables as $cardTable) {
            foreach ($cardTable as $card){
                $data[] = [
                    'table_id' => $tableId,
                    'name' => $card->name,
                    'status' => 'deck',
                    'created_at' => now(),
                    'updated_at' => now(),
                ];
            }
        }
        DB::table('cards')->insert($data);
        $table = Table::findOrFail($tableId);
        $players = $table->players;
        $colorArray = collect(['blue','brown','yellow'])->shuffle();
        $sideBarArray = collect(range(1, 5))->shuffle();
        $this->decideStartOrder($players);
        foreach ($players as $index=>$player) {
            $player->money = 10;
            $player->rock = 10;
            $player->worker = 10;
            $player->wood = 10;
            
            TempStorage::create(
                array_merge(
                    $player->only(['money','worker', 'wood', 'rock', 'score', 'military', 'belief']),
                    ['player_id' => $player->id],['table_id'=>$tableId]
                )
            );
            $player->color = $colorArray[$index];
            $player->sideBar = $sideBarArray[$index];
            $player->save();
        } 
        $this->drawCardRound1($tableId);
        $this->dice($table);
    }
    public function drawCardRound1(string $tableId){
        $cards = Card::where('table_id', $tableId)->get();
        
        $greenCards = $cards->slice(0, 8)->random(4)->shuffle();
        $blueCards = $cards->slice(24, 8)->random(4)->shuffle();
        $yellowCards = $cards->slice(48, 8)->random(4)->shuffle();
        $purpleCards = $cards->slice(72, 8)->random(4)->shuffle();
        $greenCards->each(function ($card, $index) {
            $card['status'] = 'table';
            $card['index'] = $index;
            $card->save();  // 修改 status
        });
        $blueCards->each(function ($card, $index) {
            $card['status'] = 'table';
            $card['index'] = $index;
            $card->save();  // 修改 status
        });
        $yellowCards->each(function ($card, $index) {
            $card['status'] = 'table';
            $card['index'] = $index;
            $card->save();  // 修改 status
        });
        $purpleCards->each(function ($card, $index) {
            $card['status'] = 'table';
            $card['index'] = $index;
            $card->save();  // 修改 status
        });
    }
    public function dice($table){
        $table->redDice = rand(1,6);
        $table->whiteDice = rand(1,6);
        $table->blackDice = rand(1,6);
        $table->save();
    }
    public function decideStartOrder($players){
        $players = $players->shuffle();
        foreach ($players as $index => $player) {
            $player->order = $index + 1;
            if($player->order == 1){
                $player->needAction = 'putPillar';
            }
        }
    }
       public function getPlayerOrderInfo($table){
        $players = $table->players()->orderBy('order')->select('color')->get();
        return $players;
    }
    public function nextRound(){
        dd('nextRound');
    }
}