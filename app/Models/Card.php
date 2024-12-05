<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
class Card extends Model
{
    protected $fillable = [
        'name',
        'status'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [

    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [

        ];
    }
   
    
    public function player(): BelongsTo
    {
        return $this->belongsTo(Player::class);
    }
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }
    public function getCostResource():array{
        return  ["money"=>$this->costMoney,"worker"=>$this->costWorker,"rock"=>$this->costRock,"wood"=>$this->costWood];
    }

}

