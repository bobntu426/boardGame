<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Support\Facades\DB;

class TableService
{
    public function initGameCard(string $tableId)
    {
        // 取得所有卡片名稱
        $cards = Card::select('name')->get();

        // 構建要插入的數據
        $data = [];
        foreach ($cards as $card) {
            $data[] = [
                'table_id' => $tableId,
                'name' => $card->name,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        }

        // 批量插入數據到 table_card 表
        DB::table('table_card')->insert($data);
    }
}
