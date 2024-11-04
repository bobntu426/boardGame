<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
Use App\Models\User;
Use App\Models\Card;
Use App\Models\Table;
Use App\Models\Player;
use Illuminate\Support\Facades\Auth;
use App\Events\TableJoined;
use Psy\Readline\Hoa\Console;

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
    public function addResource(array $array1,array $array2){
        foreach ($array1 as $key => $value) {
            if (isset($array2[$key])) {
                $result[$key] = $value + $array2[$key];
            }
        }
        return $result;
    }
    public function buyCard(Card $card){
        $user = Auth::user();
        $userResource = $user->getResource();
        $costResource = $card->getCostResource();
        $gainResource = $card->getGainWhenBuyResource();
        $data = [
            'before' => $userResource,
            'cost'=> $costResource,
        ];
        $result = $this->addResource($userResource,$costResource);
        foreach ($result as $value) {
            if ($value < 0) {
                $data["messenge"]="Don't have enough money!";
                return response()->json($data);
            }
        }
        $userResource = $result;
        $result = $this->addResource($userResource,$gainResource);
        $data['gain'] = $gainResource;
        $data['final'] = $result;
        $data['getCard']=$card->name;
        $user->cards()->attach($card->id);
        $user->update($result);
        return response()->json($data);
    }
    public function useCard(Card $card){
        $user = Auth::user();
        $userResource = $user->getResource();
        $gainResource = $card->getGainWhenUseResource();
        $data = [
            'before' => $userResource,
            'gain'=> $gainResource,
        ];
        $result = $this->addResource($userResource,$gainResource);
        $data['final'] = $result;
        $user->update($result);
        return response()->json($data);
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
