<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\BelongsToManyRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'table_num',
        'money',
        'rock',
        'wood',
        'worker'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
        ];
    }
    public function cards(): BelongsToMany
    {
        return $this->belongsToMany(Card::class,'user_card');
    }
    public function tables(): BelongsToMany
    {
        return $this->belongsToMany(Table::class,'table_user');
    }
    public function players(): HasMany
    {
        return $this->hasMany(Player::class,);
    }

    public function getResource():array{
        return  ["money"=>$this->money,"worker"=>$this->worker,"rock"=>$this->rock,"wood"=>$this->wood];
    }
}
