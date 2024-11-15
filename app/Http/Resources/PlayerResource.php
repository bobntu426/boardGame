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
            'money'=>$this->money,
            'worker'=>$this->worker,
            'rock'=>$this->rock,
            'wood'=>$this->wood,
            'score'=>$this->score,
            'military'=>$this->military,
            'belief'=>$this->belief,
            "order"=>$this->order,
            'redPillar'=>$this->redPillar,
            'blackPillar'=>$this->blackPillar,
            'whitePillar'=>$this->whitePillar,
            'pillar'=>$this->pillar,
            'punish1'=>$this->punish1,
            'punish2'=>$this->punish2,
            'punish3'=>$this->punish3,
            'turn'=>$this->turn,
            'user'=>$user,
        ];
        
        return $player;
        
    }
}
