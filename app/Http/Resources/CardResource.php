<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Support\Facades\DB;

class CardResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        $colors = ['green','blue','yellow','purple'];
        $cardColor = null;
        $cardTable = null;
        foreach($colors as $color){
            $cardTable = DB::table($color."_card_tables")->where('name', $this->name)->first();
            if($cardTable){
                $cardColor = $color;
                break;
            } 
        }
        
        if($cardColor == 'green'){
            $cardObj = [
                'id'=>$this->id,
                'name'=> $this->name,
                'status'=> $this->status,
                'index'=> $this->index,
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
            $cardTable = DB::table('blue_card_tables')->where('name', $this->name)->first();
        
            $cardObj = [
                'id'=>$this->id,
                'name'=> $this->name,
                'status'=> $this->status,
                'index'=> $this->index,
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
            $cardTable = DB::table('yellow_card_tables')->where('name', $this->name)->first();
            $cardObj = [
                'id'=>$this->id,
                'name'=> $this->name,
                'status'=> $this->status,
                'index'=> $this->index,
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
            $cardTable = DB::table('purple_card_tables')->where('name', $this->name)->first();
            $cardObj = [
                'id'=>$this->id,
                'name'=> $this->name,
                'status'=> $this->status,
                'index'=> $this->index,
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
                    'military'=>$cardTable->costMilitary,
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
