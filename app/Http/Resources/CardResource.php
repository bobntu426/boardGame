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
        $cardTable = DB::table('card_tables')->where('name', $this->name)->first();
        
        $cardObj = [
            'id'=>$this->id,
            'name'=> $this->name,
            'status'=> $this->status,
            'index'=> $this->index,
            'image'=>$cardTable->image,
            'color'=> $cardTable->color,
            'cost'=>[
                'money'=>$cardTable->costMoney,
                'worker'=>$cardTable->costWorker,
                'rock'=>$cardTable->costRock,
                'wood'=>$cardTable->costWood
            ],
            'buyEffect'=>[
                'money'=>$cardTable->gainMoneyWhenBuy,
                'worker'=>$cardTable->gainWorkerWhenBuy,
                'rock'=>$cardTable->gainRockWhenBuy,
                'wood'=>$cardTable->gainWoodWhenBuy,  
            ],
            'useEffect'=>[
                'money'=>$cardTable->gainMoneyWhenUse,
                'worker'=>$cardTable->gainWorkerWhenUse,
                'rock'=>$cardTable->gainRockWhenUse,
                'wood'=>$cardTable->gainWoodWhenUse,
            ]
        ];
        return $cardObj;
    }
}
