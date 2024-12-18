<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [
        'playerNum'
    ];
    protected $guarded = [];
    public function users()
    {
        return $this->hasManyThrough(User::class, Player::class, 'table_id', 'id', 'id', 'user_id');
    }
    public function players(): HasMany
    {
        return $this->hasMany(Player::class);
    }
    public function cards(): HasMany
    {
        return $this->hasMany(Card::class);
    }
}
