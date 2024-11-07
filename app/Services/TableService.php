<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Support\Facades\DB;

class TableService
{
    public function initGameCard(string $tableId)
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
    }
}
