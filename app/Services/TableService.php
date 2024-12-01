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
    public function getBoardPillarInfo($table){
        $players = $table->players()->get();
        
        $pillarPositions = collect([
            'green' => collect([null, null, null, null]),
            'blue' => collect([null, null, null, null]),
            'yellow' => collect([null, null, null, null]),
            'purple' => collect([null, null, null, null]),
            'hand'=> collect([]),
            'order' => collect([]),
            'production' => collect([]),
            'otherProduction' => collect([]),
            'harvest' => collect([]),
            'otherHarvest' => collect([]),
            'earnMoney' => collect([]),
            'earnWorker' => collect([]),
            'earnMoneyMilitary' => collect([]),
            'earnTwoReel' => collect([]),
        ]);

        $players->each(function ($player) use ($pillarPositions) {
            $playerPillarPositions = [
                'black' => $player->blackPillar, 
                'white' => $player->whitePillar,
                'red' => $player->redPillar,
                'normal' => $player->normalPillar
            ];
        
            collect($playerPillarPositions)->each(function ($position, $color) use ($pillarPositions, $player) {
                if (strpos($position, 'green') === 0 || strpos($position, 'blue') === 0 || strpos($position, 'yellow') === 0 || strpos($position, 'purple') === 0) {
                    $parts = explode('_', $position); // Assume positions like 'green_1'
                    $towerColor = $parts[0]; 
                    $index = intval($parts[1]) - 1; // '1' to 0 index
                    
                    // Update the tower position
                    $pillarPositions[$towerColor][$index] = [
                        'playerId' => $player->id,
                        'playerColor' =>$player->color,
                        'color' => $color
                    ];
                } else {
                    $pillarPositions->get($position)->push([
                        'playerId' => $player->id,
                        'playerColor' =>$player->color,
                        'color' => $color
                    ]);
                }
            });
        });

        return $pillarPositions;
    }
    public function getPlayerOrderInfo($table){
        $players = $table->players()->orderBy('order')->select('color')->get();
        return $players;
    }
    public function nextRound(){
        dd('nextRound');
    }
}