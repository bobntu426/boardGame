<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Support\Facades\DB;

class CardService
{
    public function formCardObject(Card $card)
    {
        $cardObj = [
            'name'=> $card->name,
            'image'=>$card->image,
            'color'=> $card->color,
            'cost'=>[
                'money'=>$card->costMoney,
                'wood'=>$card->costWood,
                'rock'=>$card->costRock,
                'worker'=>$card->costWorker
            ],
            'buyEffect'=>[
                'money'=>$card->gainMoneyWhenBuy,
                'wood'=>$card->gainWoodWhenBuy,
                'rock'=>$card->gainRockWhenBuy,
                'worker'=>$card->gainWorkerWhenBuy
            ],
            'useEffect'=>[
                'money'=>$card->gainMoneyWhenUse,
                'wood'=>$card->gainWoodWhenUse,
                'rock'=>$card->gainRockWhenUse,
                'worker'=>$card->gainWorkerWhenUse
            ]
        ];
        return $cardObj;
    }
}
