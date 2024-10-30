<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Model;

class Table extends Model
{
    protected $fillable = [

    ];
    public function users(): BelongsToMany
    {
        return $this->belongsToMany(User::class,'table_user');
    }
}
