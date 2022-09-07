<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use \Staudenmeir\LaravelMergedRelations\Eloquent\HasMergedRelationships;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
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

    public function friendsTo()
    {
        return $this->belongsToMany(User::class, 'friends', 'user_id', 'friend_id')->withTimestamps();
    }

    public function friendsFrom()
    {
        return $this->belongsToMany(User::class, 'friends', 'friend_id', 'user_id')->withTimestamps();
    }

    public function hasPendingFriendRequestTo(User $user)
    {
        return $this->friendsTo->contains($user->id);
    }

    public function hasPendingFriendRequestFrom(User $user)
    {
        return $this->friendsFrom->contains($user->id);
    }

    public function acceptedFriendsTo()
    {
        return $this->friendsTo()->wherePivot('accepted', true);
    }

    public function acceptedFriendsFrom()
    {
        return $this->friendsFrom()->wherePivot('accepted', true);
    }

    public function friends()
    {
        return $this->mergedRelationWithModel(User::class, 'friends_view');
    }

    public function isFriendsWith(User $user)
    {
        return $this->friends->contains($user->id);
    }
}
