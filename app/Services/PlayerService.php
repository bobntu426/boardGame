<?php

namespace App\Services;
Use App\Models\Player;
Use App\Models\TempStorage;
Use App\Models\Card;
use App\Events\ToNextPlayer;
use App\Events\ToSureAction;
use App\Events\ResetEvent;
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
        if($targetPlayer->order != $table->playerNum){
            
            $nextPlayer = Player::where('order',$targetPlayer->order+1)->first();
            $nextPlayer->needAction = 'putPillar';
            $targetPlayer->needAction = "wait";
            ToNextPlayer::dispatch($targetPlayer,$nextPlayer);
            $nextPlayer->save();
        }else {    
            if($this->getPillarNum($targetPlayer)==0){
                $this->tableService->nextRound();
            }else{
                $nextPlayer = Player::where('order',1)->first();
                $nextPlayer->needAction = 'putPillar';
                $targetPlayer->needAction = "wait";
                ToNextPlayer::dispatch($targetPlayer,$nextPlayer);
                $nextPlayer->save();
            }
        }
    }
    public function toSureAction($targetPlayer){
        $targetPlayer->needAction = "sure";
        ToSureAction::dispatch($targetPlayer);
    }
    public function updateTempStorage(Player $player,TempStorage $originalPlayer ){
        $originalPlayer->update([
            'action'=>null,
            'pillarColor'=> null,
            'money' => $player->money,
            'wood' => $player->wood,
            'rock' => $player->rock,
            'worker' => $player->worker,
            'military' => $player->military,
            'belief' => $player->belief,
            'nextOrder' => $player->nextOrder,
            'score' => $player->score,
        ]);
    }
    public function resetPlayer(Player $player,TempStorage $originalPlayer ){
        $pillarColor = $originalPlayer->pillarColor;
        $player->update([
            'needAction'=>'putPillar',
            $pillarColor."Pillar" => "hand",
            'money' => $originalPlayer->money,
            'wood' => $originalPlayer->wood,
            'rock' => $originalPlayer->rock,
            'worker' => $originalPlayer->worker,
            'military' => $originalPlayer->military,
            'belief' => $originalPlayer->belief,
            'nextOrder' => $originalPlayer->nextOrder,
            'score' => $originalPlayer->score,
        ]);
        resetEvent::dispatch($player,$originalPlayer->pillarColor,$originalPlayer->action);
        $originalPlayer->update([
            'pillarColor'=>null,
            'action'=>null
        ]);
    }
}
