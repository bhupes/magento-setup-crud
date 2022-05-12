<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    const isTrue = 1;
    const isFalse = 0;

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
        'username',
        'phone_number',
        'is_active',
        'is_deleted'
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

    /**
     * The "booted" method of the model.
     *
     * @return void
     */
    protected static function booted()
    {
        static::addGlobalScope('globalCollection', function (Builder $builder) {
            $builder->where('is_active', self::isTrue)->where('is_deleted', self::isFalse);
        });
    }

    /**
     * Get the judge session for the artwork.
     */
    public function userSession()
    {
        return $this->hasMany(JudgeSession::class, 'UserId', 'id')
            ->select(['Id', 'Position', 'CollectionId', 'ShortlistId']);
    }

    /**
     * Get the judge session for the artwork.
     */
    public function sortListedArtwork()
    {
        return $this->hasMany(SortLisedArtwork::class, 'UserId', 'id')
            ->select(['ArtworkId', 'SortlistId', 'Comment']);
    }
}
