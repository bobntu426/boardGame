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
use Illuminate\Support\Facades\Auth;
class TableCreated implements ShouldBroadcastNow
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     */
    public $table;
    public $user;
    public function __construct(Table $table, User $user)
    {
        $this->table = $table;
        $this->user = $user;
    }
    public function broadcastOn(): array
    {
        return [
            new Channel('lobby')
        ];
    }
    public function broadcastWith(){

        $this->table->users[0]=$this->user; // 确保加?相?用?

        return [
            'data' => [
                'table' => $this->table // 返回整? table ?象
            ]
        ];
        

    }
}
