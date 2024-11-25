<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Player;

class CheckPlayerTurnAndPillar
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $playerId = $request->playerId;
        $player =  Player::find($playerId);
        if ($player->needAction=='wait') {
            return response()->json(['message' => '非您的回合'], 401);
        } 
        return $next($request);
    }
}
