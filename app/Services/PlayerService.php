<?php

namespace App\Services;
Use App\Models\Player;
Use App\Models\Card;

class PlayerService{
    protected $tableService;
    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
        
    }
    public function addResource(array $array1,array $array2){
        foreach ($array1 as $key => $value) {
            if (isset($array2[$key])) {
                $result[$key] = $value + $array2[$key];
            }
        }
        return $result;
    }
    public function HandleBuyCard(Player $player, $card) {
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
    public function handleUseCard(Player $player, $card) {    
       
        $playerResource = $player->getResource();
        
        $data = [
            'before' => $playerResource,
            'gain'=> $card['useEffect'],
        ];
        $data['finalResult'] = $this->addResource($playerResource,$card['useEffect']);
        $player->update($data['finalResult']);
        return response()->json($data);
    }
    public function setOrderAhead($targetPlayer){
        $table = $targetPlayer->table;
        $players = $table->players;
        $nextOrder = 1;
        $players->each(function($player)use(&$nextOrder,$targetPlayer){ 
            if($player->nextOrder){
                $nextOrder++;
            }
        });
        if(!$targetPlayer->nextOrder)
            $targetPlayer->nextOrder = $nextOrder;
    }
    public function earnResourceFromReel($targetPlayer,$reels){
        foreach($reels as $reel ){
            switch($reel){
                case 'resource':
                    $targetPlayer->rock++;
                    $targetPlayer->wood++;
                    break;
                case 'worker':
                    $targetPlayer->worker+=2;
                    break;
                case 'money':
                    $targetPlayer->money+=2;
                    break;
                case 'military':
                    $targetPlayer->military+=2;
                    break;
                case 'belief':
                    $targetPlayer->belief++;
                    break;
                default:break;
            }
        }
    }
    public function getPillarNum($player){
        $pillars = [$player->redPillar,$player->blackPillar,$player->whitePillar,$player->normalPillar];
        $pillarNum = 0;
        foreach($pillars as $pillar){
            if($pillar == 'hand'){
                $pillarNum++;
            }
        }
        return $pillarNum;
    }
    public function decideNextAction($targetPlayer){
        $table = $targetPlayer->table;
        //dd($this->getPillarNum($targetPlayer));
        if($targetPlayer->order != $table->playerNum){
            
            $nextPlayer = Player::where('order',$targetPlayer->order+1)->first();
            $nextPlayer->needAction = 'putPillar';
            $targetPlayer->needAction = "wait";
            $nextPlayer->save();
        }else {    
            if($this->getPillarNum($targetPlayer)==0){
                $this->tableService->nextRound();
            }else{
                $nextPlayer = Player::where('order',1)->first();
                $nextPlayer->needAction = 'putPillar';
                $targetPlayer->needAction = "wait";
                $nextPlayer->save();
            }
        }
        
        
    }
    
}
