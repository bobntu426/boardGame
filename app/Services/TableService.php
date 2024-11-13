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
        
    }
}
