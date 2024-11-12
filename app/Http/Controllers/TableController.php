<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Models\Table;
Use App\Models\Card;
use App\Services\TableService;
use App\Services\CardService;
Use App\Models\Player;
use App\Events\TableCreated;
use Illuminate\Support\Facades\Auth;
use Illuminate\Routing\Controllers\HasMiddleware;

class TableController
{
    protected $tableService;
    public function __construct(TableService $tableService)
    {
        $this->tableService = $tableService;
        
    }
    public function getTable()
    {
        $tables = Table::with('users')->get();
        return response()->json([
            'status' => 1,
            'tables' => $tables
        ],200);
    }
    public function createTable(Request $request)
    {
        $user = Auth::user();
        $data = $request->all();
        if (!array_key_exists('playerNum', $data)) {
            $data['playerNum'] = 2;
        }
        $table = Table::create($data);
        
        $player = new Player();
        $player->user()->associate(Auth::user());
        $player->table()->associate($table);
        $player->save();
        
        TableCreated::dispatch($table, $user);
    }


    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Table::find( $id )
        ->update( $request->all() );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Table::find( $id )
        ->delete();
    }
    
    public function getTableCards(string $tableId)
    {
        $cards =Card::where('table_id', $tableId)->get();
        $cardService = new CardService();
        $cardObjects = $cards->map(function ($card) use ($cardService) {
            return $cardService->formCardObject($card);
        });
        return response()->json($cardObjects);
    }
    
}
