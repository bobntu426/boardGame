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
use App\Http\Resources\PlayerResource;
use Illuminate\Support\Facades\Auth;
class ResetEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $player;
    public $pillarColor;
    public $action;
   
    public function __construct(Player $player,$pillarColor,$action)
    {
        $this->player = $player;
        $this->pillarColor = $pillarColor;
        $this->action = $action;
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
            'playerNewData'=>new PlayerResource($this->player),
            'action' => $this->action,
            'pillarColor' => $this->pillarColor
        ];
    }
}