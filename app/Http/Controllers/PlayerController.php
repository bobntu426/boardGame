<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Player;
Use App\Models\Card;

Use App\Models\Table;
use Illuminate\Support\Facades\Auth;
use App\Events\TableJoined;
use App\Events\TableLeaved;
use App\Services\TableService;
use App\Services\CardService;
use App\Services\PlayerService;
use App\Http\Resources\CardResource;
use App\Http\Resources\PlayerResource;
class PlayerController
{
    protected $playerService;
    public function __construct(PlayerService $playerService)
    {
        $this->playerService = $playerService;
    }
    public function index()
    {
        $players = Player::all();
        return $players;
    }

    
    public function buyCard(Request $request){
        $player = Player::find( $request->playerId );
        $card = $request->card;
        $resultObj = $this->playerService->HandleBuyCard($player, $card);
        return response()->json($resultObj);
    }
    public function useCard(Request $request){
        $cardObj = $request;
        $cardModel = Card::find( $request['id']  );
        $player = $cardModel->player;
        $resultObj = $this->playerService->HandleUseCard($player, $cardObj);
        
        
        return response()->json($resultObj);
    }
    public function getCard(User $user){
        $cards = $user->cards;
        return $cards;
    }
    public function getPlayerCards(Player $player){
        $cards = $player->cards;
        $cardService = new CardService();
        $cardObjects = $cards->map(function ($card) use ($cardService) {
            return $cardService->formCardObject($card);
        });
        //return response()->json($cardObjects);
        return CardResource::collection($cards);
    }
    public function getMe()
    {
        $user = Auth::user();
        return $user;
    }
    public function joinTable(Table $table, TableService $tableService){
        $user = Auth::user();
        TableJoined::dispatch($table, $user);
        $player = new Player();
        $player->user()->associate(Auth::user());
        $player->table()->associate($table);
        $player->save();
        if($table->playerNum==$table->players()->count()){
            $tableService->initGame($table->id);
        }
    }
    public function leaveTable(Table $table){
        $user = Auth::user();
        $player = $user->players()->where('table_id', $table->id)->first();
        $player->delete();
        $remainingPlayersCount = $table->players()->count();
        $tempTable = new Table();
        $tempTable->id = $table->id;
        if ($remainingPlayersCount == 0) {
            $table->delete();
        }
        TableLeaved::dispatch($tempTable, $user);
    }
    public function getPlayerInTable(Table $table){
        $players = Player::where('table_id', $table->id)->get();
        return PlayerResource::collection($players);
    }
    public function decideOrder(Request $request){
        $playerId = $request->playerId;
        $player = Player::find($playerId);
        $pillarColor = $request->chooseColor;
        $player["$pillarColor"."Pillar"] = 'order';
        $this->playerService->setOrderAhead($player);
        $this->playerService->earnResourceFromReel($player,$request->reels);
        $this->playerService->decideNextAction($player);
        $player->save();
    }
}
