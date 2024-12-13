<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Card;
Use App\Models\Table;
Use App\Models\Player;
use Illuminate\Support\Facades\Auth;


class UserController
{
       /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $users = User::all();
        return $users;
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
        User::create($request->all());
        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::find( $id );
        return $user;
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        User::find( $id )
        ->update( $request->all() );
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        User::find( $id )
        ->delete();
    }
    
    public function getCard(User $user){
        $cards = $user->cards;
        return $cards;
    }
    public function getMyCard(Request $request){
        $cards =  Auth::user()->cards;
        return $cards;
    }
    public function getMe()
    {
        $user = Auth::user();
        return $user;
    }


}
