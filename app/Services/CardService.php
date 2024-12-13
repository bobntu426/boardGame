<?php

namespace App\Services;

use App\Models\Card;
use Illuminate\Support\Facades\DB;

class CardService
{
    public static function formCardObject($card)
    {
        $colors = ['green','blue','yellow','purple'];
        $cardColor = null;
        $cardTable = null;
        foreach($colors as $color){
            $cardTable = DB::table($color."_card_tables")->where('name', $card->name)->first();
            if($cardTable){
                $cardColor = $color;
                break;
            } 
        }
        
        if($cardColor == 'green'){
            $cardObj = [
                'id'=>$card->id,
                'name'=> $card->name,
                'status'=> $card->status,
                'index'=> $card->index,
                'image'=>$cardTable->image,
                'color'=> $cardTable->color,
                'buyEffect'=>[
                    'money'=>$cardTable->gainMoneyWhenBuy,
                    'worker'=>$cardTable->gainWorkerWhenBuy,
                    'rock'=>$cardTable->gainRockWhenBuy,
                    'wood'=>$cardTable->gainWoodWhenBuy, 
                    'military'=>$cardTable->gainMilitaryWhenBuy, 
                    'belief'=>$cardTable->gainBeliefWhenBuy, 
                    'score'=>$cardTable->gainScoreWhenBuy, 
                    'reel'=>$cardTable->gainReelWhenBuy, 
                ],
                'useEffect'=>[
                    'money'=>$cardTable->gainMoneyWhenUse,
                    'worker'=>$cardTable->gainWorkerWhenUse,
                    'rock'=>$cardTable->gainRockWhenUse,
                    'wood'=>$cardTable->gainWoodWhenUse,
                    'military'=>$cardTable->gainMilitaryWhenUse,
                    'belief'=>$cardTable->gainBeliefWhenUse,
                    'score'=>$cardTable->gainScoreWhenUse,
                    'reel'=>$cardTable->gainReelWhenUse,
                ]
            ];
            return $cardObj;
        }else if($cardColor == 'blue'){
            $cardTable = DB::table('blue_card_tables')->where('name', $card->name)->first();
        
            $cardObj = [
                'id'=>$card->id,
                'name'=> $card->name,
                'status'=> $card->status,
                'index'=> $card->index,
                'image'=>$cardTable->image,
                'color'=> $cardTable->color,
                'function'=> $cardTable->function,
                'point'=> $cardTable->point,
                'functionTarget'=> $cardTable->functionTarget,
                'cost'=>[
                    'money'=>$cardTable->costMoney,
                ],
                'buyEffect'=>[
                    'military'=>$cardTable->gainMilitaryWhenBuy, 
                    'belief'=>$cardTable->gainBeliefWhenBuy, 
                    'score'=>$cardTable->gainScoreWhenBuy, 
                    'reel'=>$cardTable->gainReelWhenBuy, 
                ],
            ];
            return $cardObj;
        }else if($cardColor == 'yellow'){
            $cardTable = DB::table('yellow_card_tables')->where('name', $card->name)->first();
            $cardObj = [
                'id'=>$card->id,
                'name'=> $card->name,
                'status'=> $card->status,
                'index'=> $card->index,
                'image'=>$cardTable->image,
                'color'=> $cardTable->color,
                'productionPoint'=> $cardTable->productionPoint,
                'functionColor'=> $cardTable->functionColor,
                'twoTrigger'=> $cardTable->twoTrigger,
                'chooseOneCost'=> $cardTable->chooseOneCost,

                'cost'=>[
                    'money'=>$cardTable->costMoney,
                    'worker'=>$cardTable->costWorker,
                    'rock'=>$cardTable->costRock,
                    'wood'=>$cardTable->costWood
                ],
                'buyEffect'=>[
                    'belief'=>$cardTable->gainBeliefWhenBuy, 
                    'score'=>$cardTable->gainScoreWhenBuy,  
                ],
                'useEffect1'=>[
                    'money'=>$cardTable->gainMoneyWhenUse1,
                    'worker'=>$cardTable->gainWorkerWhenUse1,
                    'rock'=>$cardTable->gainRockWhenUse1,
                    'wood'=>$cardTable->gainWoodWhenUse1,
                    'military'=>$cardTable->gainMilitaryWhenUse1,
                    'belief'=>$cardTable->gainBeliefWhenUse1,
                    'score'=>$cardTable->gainScoreWhenUse1,
                ],
                'useEffect2'=>[
                    'money'=>$cardTable->gainMoneyWhenUse2,
                    'rock'=>$cardTable->gainRockWhenUse2,
                    'wood'=>$cardTable->gainWoodWhenUse2,
                    'score'=>$cardTable->gainScoreWhenUse2,
                ],
                'useCost1'=>[
                    'money'=>$cardTable->gainMoneyWhenUse1,
                    'worker'=>$cardTable->gainWorkerWhenUse1,
                    'rock'=>$cardTable->gainRockWhenUse1,
                    'wood'=>$cardTable->gainWoodWhenUse1,
                    'belief'=>$cardTable->gainBeliefWhenUse1,
                ],
                'useCost2'=>[
                    'money'=>$cardTable->gainMoneyWhenUse2,
                    'rock'=>$cardTable->gainRockWhenUse2,
                    'wood'=>$cardTable->gainWoodWhenUse2,
                ],
                
            ];
            return $cardObj;
        }else{
            $cardTable = DB::table('purple_card_tables')->where('name', $card->name)->first();
            $cardObj = [
                'id'=>$card->id,
                'name'=> $card->name,
                'status'=> $card->status,
                'index'=> $card->index,
                'image'=>$cardTable->image,
                'color'=> $cardTable->color,
                'function'=> $cardTable->function,
                'point'=> $cardTable->point,
                'needMilitary'=> $cardTable->needMilitary,
                'gainScoreEnd'=> $cardTable->gainScoreEnd,

                'cost'=>[
                    'money'=>$cardTable->costMoney,
                    'worker'=>$cardTable->costWorker,
                    'rock'=>$cardTable->costRock,
                    'wood'=>$cardTable->costWood,
                    'military'=>$cardTable->needMilitary,
                ],
                'buyEffect'=>[
                    'money'=>$cardTable->gainMoneyWhenBuy,
                    'worker'=>$cardTable->gainWorkerWhenBuy,
                    'rock'=>$cardTable->gainRockWhenBuy,
                    'wood'=>$cardTable->gainWoodWhenBuy, 
                    'military'=>$cardTable->gainMilitaryWhenBuy, 
                    'belief'=>$cardTable->gainBeliefWhenBuy, 
                    'score'=>$cardTable->gainScoreWhenBuy, 
                    'reel'=>$cardTable->gainReelWhenBuy, 
                ],
            ];
            return $cardObj;
        }
    }
}
