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
class ToSureAction implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $player;
   
    public function __construct(Player $player)
    {
        $this->player = $player;
    }
    public function broadcastOn(): array
    {
        $tableId = $this->player->table->id;
        return [
            new Channel('table.'.$tableId)
        ];
    }
    public function broadcastWith(){
        return [
            'playerId'=>$this->player->id,
        ];
    }
}