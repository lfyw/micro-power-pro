<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = [];

    protected $casts = [
        'status' => 'boolean'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
    ];


    /**
     * creator
     * 创建者
     * @return BelongsTo
     */
    public function creator():BelongsTo
    {
        return $this->belongsTo(self::class, 'creator_id');
    }

    /**
     * createSingleToken
     *
     * @param  mixed $client
     * @return string
     */
    public function createSingleToken(string $client):string
    {
        $this->tokens()->whereName($client)->delete();
        return $this->createToken($client)->plainTextToken;
    }

}
