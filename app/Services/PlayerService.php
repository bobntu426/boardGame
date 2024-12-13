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
    

    public function HandleBuyCard(Player $player, $card) {
        $cardObj = CardService::formCardObject($card);
        BuyCardService::costResource($player,$cardObj);
        BuyCardService::buyEffect($player,$cardObj);
        $card->player()->associate($player);
        $card->save();
        return response()->json(['status'=>'success']);
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
        $action = $originalPlayer->action;
        $data = [
            'needAction'=>'putPillar',
            $pillarColor."Pillar" => "hand",
            'money' => $originalPlayer->money,
            'wood' => $originalPlayer->wood,
            'rock' => $originalPlayer->rock,
            'worker' => $originalPlayer->worker,
            'military' => $originalPlayer->military,
            'belief' => $originalPlayer->belief,
            'score' => $originalPlayer->score,
        ];
        switch($action){
            case 'order':
                $data['nextOrder']=$originalPlayer->nextOrder;
                break;
            case 'buyCard':
                $data['card_id']=$originalPlayer->card_id;
                $data['extraProduction']=$originalPlayer->extraProduction;
                $data['extraHarvest']=$originalPlayer->extraHarvest;
                $data['extraGreenPoint']=$originalPlayer->extraGreenPoint;
                $data['extraBluePoint']=$originalPlayer->extraBluePoint;
                $data['extraYellowPoint']=$originalPlayer->extraYellowPoint;
                $data['extraPurplePoint']=$originalPlayer->extraPurplePoint;
                break;
            
        }

           
        ;
        $player->update($data);
        resetEvent::dispatch($player);
        $originalPlayer->update([
            'pillarColor'=>null,
            'action'=>null
        ]);
    }
}
