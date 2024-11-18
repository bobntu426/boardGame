<?php

namespace App\Services;

use App\Models\Card;
use App\Models\Player;
use App\Models\Table;
use Illuminate\Support\Facades\DB;

class TableService
{

    public function initGame(string $tableId)
    {
        // 取得所有卡片名稱
        $cardTables = DB::table('card_tables')->get();
        // 構建要插入的數據
        $data = [];
        foreach ($cardTables as $card) {
            $data[] = [
                'table_id' => $tableId,
                'name' => $card->name,
                'status' => 'deck',
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }
        DB::table('cards')->insert($data);
        $table = Table::findOrFail($tableId);
        $players = $table->players;
        foreach ($players as $player) {
            $player->money = 10;
            $player->rock = 10;
            $player->worker = 10;
            $player->wood = 10;
            $player->save();
        } 
        $this->drawCardRound1($tableId);
        $this->dice($table);
        $this->decideOrder($table);
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
        $table->redDice = rand(1,7);
        $table->whiteDice = rand(1,7);
        $table->blackDice = rand(1,7);
        $table->save();
    }
    public function decideOrder($table){
        $players = $table->players()->get()->shuffle();
        foreach ($players as $index => $player) {
            $player->order = $index + 1;
            if($player->order == 1){
                $player->turn = true;
            }
            $player->save();
        }
    }
    public function getBoardPillarInfo($table){
        $players = $table->players()->get();
        $pillarPositions = collect([]);
        
        $players->each(function ($player) use ($pillarPositions) {
            $playerPillarPositions = [
                'black' => $player->blackPillar, 
                'white' => $player->whitePillar,
                'red' => $player->redPillar,
                'pillar' => $player->pillar
            ];
        
            collect($playerPillarPositions)
            ->each(function ($position, $color) use ($pillarPositions, $player) {
                $pillarPositions->push(['playerId' => $player->id, 'color' => $color, 'position' => $position]);
            });
        });
        return $pillarPositions;
    }
}