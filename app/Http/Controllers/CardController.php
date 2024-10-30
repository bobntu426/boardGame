<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
Use App\Models\Card;

class CardController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cards = Card::all();
        return $cards;
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
        //dd($request->all());
        Card::create($request->all());
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $card = Card::find( $id );
        return $card;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        Card::find( $id )
        ->update( $request->all() );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Card::find( $id )
        ->delete();
    }
}
