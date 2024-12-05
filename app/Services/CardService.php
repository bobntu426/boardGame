<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Support\Facades\DB;

class CardService
{
    // public function formCardObject(Card $card)
    // {
    //     $cardTable = DB::table('card_tables')->where('name', $card->name)->first();
        
    //     $cardObj = [
    //         'id'=>$card->id,
    //         'name'=> $card->name,
    //         'image'=>$cardTable->image,
    //         'color'=> $cardTable->color,
    //         'cost'=>[
    //             'money'=>$cardTable->costMoney,
    //             'worker'=>$cardTable->costWorker,
    //             'rock'=>$cardTable->costRock,
    //             'wood'=>$cardTable->costWood
    //         ],
    //         'buyEffect'=>[
    //             'money'=>$cardTable->gainMoneyWhenBuy,
    //             'worker'=>$cardTable->gainWorkerWhenBuy,
    //             'rock'=>$cardTable->gainRockWhenBuy,
    //             'wood'=>$cardTable->gainWoodWhenBuy,
                
                
    //         ],
    //         'useEffect'=>[
    //             'money'=>$cardTable->gainMoneyWhenUse,
    //             'worker'=>$cardTable->gainWorkerWhenUse,
    //             'rock'=>$cardTable->gainRockWhenUse,
    //             'wood'=>$cardTable->gainWoodWhenUse,
    //         ]
    //     ];
    //     return collect($cardObj);
    // }
}
