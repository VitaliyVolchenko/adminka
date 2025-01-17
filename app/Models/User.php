<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use http\Params;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
        'avatar',
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
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    const STATUS_INACTIVE = 0;
    const STATUS_ACTIVE = 1;
    const STATUSES = [
        self::STATUS_INACTIVE,
        self::STATUS_ACTIVE,
    ];

    ### Accessors && Mutators ###

    /**
     * @param $value
     * @return string|null
     */
    public function getAvatarAttribute($value): string|null
    {
        return $this->attributes['avatar'] ? 'storage' . $this->attributes['avatar'] : null;

    }

    /**
     * @param $value
     * @return void
     */
    public function setAvatarAttribute($value): void
    {
        $path = explode('storage', $value);

        $this->attributes['avatar'] = $path[1];
    }


}
