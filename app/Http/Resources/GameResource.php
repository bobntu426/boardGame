<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;


class GameResource extends JsonResource
{
   
    public function toArray(Request $request): array
    {
        
        $gameMes=[
            'id' => $this->id,
            'playerNum' => $this->playerNum,
            'round' => $this->round,
            'redDice' => $this->redDice,
            'whiteDice' => $this->whiteDice,
            'blackDice' => $this->blackDice,
            'punish1' => $this->punish1,
            'punish2' => $this->punish2,
            'punish3' => $this->punish3,
            'pillarInfo' => $this->pillarInfo
        ];
        return $gameMes;
    }
}