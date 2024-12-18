<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class PlayerResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {   
        $user =[ 
            'id'=>$this->user->id,
            'name'=>$this->user->name,
        ];
        
        $player =[
            'id'=> $this->id,
            'sideBar'=>$this->sideBar,
            'money'=>$this->money,
            'worker'=>$this->worker,
            'rock'=>$this->rock,
            'wood'=>$this->wood,
            'score'=>$this->score,
            'military'=>$this->military,
            'belief'=>$this->belief,
            "order"=>$this->order,
            "nextOrder"=>$this->nextOrder,
            'redPillar'=>$this->redPillar,
            'blackPillar'=>$this->blackPillar,
            'whitePillar'=>$this->whitePillar,
            'normalPillar'=>$this->normalPillar,
            'punish1'=>$this->punish1,
            'punish2'=>$this->punish2,
            'punish3'=>$this->punish3,
            'extraProduction'=>$this->extraProduction,
            'extraHarvest'=>$this->extraHarvest,
            'extraGreenPoint'=>$this->extraGreenPoint,
            'extraBluePoint'=>$this->extraBluePoint,
            'extraYellowPoint'=>$this->extraYellowPoint,
            'extraPurplePoint'=>$this->extraPurplePoint,
            'needAction'=>$this->needAction,
            'turn'=>$this->turn,
            'color'=>$this->color,
            'user'=>$user,
        ];
        
        return $player;
        
    }
}
