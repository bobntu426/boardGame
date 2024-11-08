<?php

namespace App\Services;
Use App\Models\Player;
Use App\Models\Card;
class PlayerService{
    public function addResource(array $array1,array $array2){
        foreach ($array1 as $key => $value) {
            if (isset($array2[$key])) {
                $result[$key] = $value + $array2[$key];
            }
        }
        return $result;
    }
    public function HandBuyCard(Player $player, $card) {
        $playerResource = $player->getResource();
        $data = [
            'before' => $playerResource,
            'cost'=> $card['cost'],
        ];
        $data['costResult'] = $this->addResource($playerResource,$card['cost']);
        foreach ($data['costResult'] as $value) {
            if ($value < 0) {
                $data["messenge"]="Don't have enough money!";
                return response()->json($data);
            }
        }
        
        $data['gain'] = $card['buyEffect'];
        $data['finalResult'] = $this->addResource($data['costResult'],$card['buyEffect']);
        
        $data['getCard']=$card['name'];

        $cardModel = Card::find( $card['id'] );
        $cardModel->player()->associate($player);
        $cardModel->save();
        $player->update($data['finalResult']);
        return $data;
    }
    public function handUseCard(Player $player, $card) {    
       
        $playerResource = $player->getResource();
        
        $data = [
            'before' => $playerResource,
            'gain'=> $card['useEffect'],
        ];
        $data['finalResult'] = $this->addResource($playerResource,$card['useEffect']);
        $player->update($data['finalResult']);
        return response()->json($data);
    }
}
