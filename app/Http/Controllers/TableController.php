<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
Use App\Models\Table;
use App\Events\TableCreated;
use Illuminate\Support\Facades\Auth;
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
        $user->tables()->attach($table->id);
        TableCreated::dispatch($table, $user);
        //broadcast(new TableCreated($table, $user))->toOthers();
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
}
