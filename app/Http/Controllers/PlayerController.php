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
        $playerResource = $player->getResource();
        
        $data = [
            'before' => $playerResource,
            'cost'=> $card['cost'],
        ];
        $result = $this->playerService->addResource($playerResource,$card['cost']);
        foreach ($result as $value) {
            if ($value < 0) {
                $data["messenge"]="Don't have enough money!";
                return response()->json($data);
            }
        }
        $result = $this->playerService->addResource($playerResource,$card['buyEffect']);
        $data['gain'] = $card['buyEffect'];
        $data['final'] = $result;
        $data['getCard']=$card['name'];

        $cardModel = Card::find( $card['id'] );
        $cardModel->player()->associate($player);
        $cardModel->save();

        $player->update($result);
        return response()->json($data);
    }
    public function useCard(Request $request){
        $cardObj = $request;
        $cardModel = Card::find( $request['id']  );
        $player = $cardModel->player;
        $playerResource = $player->getResource();
        
        $data = [
            'before' => $playerResource,
            'gain'=> $cardObj['buyEffect'],
        ];
        $result = $this->playerService->addResource($playerResource,$cardObj['buyEffect']);
        $data['final'] = $result;
        
        $player->update($result);
        return response()->json($data);
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
        return response()->json($cardObjects);
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
            $tableService->initGameCard($table->id);
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
        $user = Auth::user();
        $players = Player::with('user')->where('table_id', $table->id)->get();
        
        return response()->json($players);
    }
}
