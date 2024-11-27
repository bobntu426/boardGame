<?php

namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
Use App\Models\Table;
Use App\Models\User;
Use App\Models\Player;
use Illuminate\Support\Facades\Auth;
class NeedActionUpdated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $nextPlayer;
   
    public function __construct(Player $nextPlayer)
    {
        $this->nextPlayer = $nextPlayer;
    }
    public function broadcastOn(): array
    {
        $tableId = $this->nextPlayer->table->id;
        return [
            new Channel('table.'.$tableId)
        ];
    }
    public function broadcastWith(){
        return [
            'nextPlayerId'=>$this->nextPlayer->id
        ];
    }
}