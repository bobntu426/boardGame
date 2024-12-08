<?php

namespace App\Events;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcastNow;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
Use App\Models\Player;
use App\Http\Resources\PlayerResource;

class ResetEvent implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $player;
    public $pillarColor;
    public $action;
   
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
            'playerNewData'=>new PlayerResource($this->player),
        ];
    }
}