<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    public $timestamps = false;
    protected $fillable = [
        "money",
        "rock",
        'wood',
        'worker',
        'user_id',
        'table_id'
    ];
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
    public function table(): BelongsTo
    {
        return $this->belongsTo(Table::class);
    }
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
    public function getResource():array{
        return  ["money"=>$this->money,"worker"=>$this->worker,"rock"=>$this->rock,"wood"=>$this->wood];
    }
}
