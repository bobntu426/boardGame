<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Card extends Model
{
    protected $fillable = [
        'name',
        'color',
        'image',
        'gainMoneyWhenBuy',
        'gainRockWhenBuy',
        'gainWoodWhenBuy',
        'gainWorkerWhenBuy',
        'gainMoneyWhenUse',
        'gainRockWhenUse',
        'gainWorkerWhenUse',
        'gainWoodWhenUse',
        'costMoney',
        'costWood',
        'costRock',
        'costWorker',
        'user_id'
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
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(Card::class);
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
    public function getGainWhenBuyResource():array{
        return  ["money"=>$this->gainMoneyWhenBuy,"worker"=>$this->gainWorkerWhenBuy,"rock"=>$this->gainRockWhenBuy,"wood"=>$this->gainWoodWhenBuy];
    }
    public function getGainWhenUseResource():array{
        return  ["money"=>$this->gainMoneyWhenUse,"worker"=>$this->gainWorkerWhenUse,"rock"=>$this->gainRockWhenUse,"wood"=>$this->gainWoodWhenUse];
    }
}
