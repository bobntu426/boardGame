<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Player extends Model
{
    protected $fillable = [
        "money",
        "rock",
        'wood',
        'worker',
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
}
