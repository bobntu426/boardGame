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
use Illuminate\Support\Facades\DB;
class TableController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tables = Table::with('users')->get();
        return response()->json($tables);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $user = Auth::user();
        $table = Table::create($request->all());
        $player = new Player();
        $player->user()->associate(Auth::user());
        $player->table()->associate($table);
        $player->save();
        
        TableCreated::dispatch($table, $user);


    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $table = Table::find( $id );
        return $table;
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
    public function initGameCard(string $tableId, TableService $tableService)
    {
        $tableService->initGameCard($tableId);
    
        return response()->json(['message' => 'Game initialized successfully.']);
    }
    public function getTableCards(string $tableId)
    {
        $cardNames = DB::table('table_card')
        ->where('table_id', $tableId)
        ->pluck('name');
        $cards = Card::whereIn('name', $cardNames)->get();
        $cardService = new CardService();
        $cardObjects = $cards->map(function ($card) use ($cardService) {
            return $cardService->formCardObject($card);
        });
        return response()->json($cardObjects);
    }
    
}
