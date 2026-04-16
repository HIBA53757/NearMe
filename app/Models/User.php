<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use App\Models\Experience;

class User extends Authenticatable
{
    use HasFactory, Notifiable ;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'bio',
        'profile_photo',
        'role',
        'is_banned',

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

    public function experiences() {
        return $this->hasMany(Experience::class);
    }

     public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function savedExperiences()
{
    return $this->belongsToMany(Experience::class, 'saveds', 'user_id', 'experience_id')
                ->withTimestamps();
}

    public function moderations() {
        return $this->hasMany(Moderation::class, 'admin_id');
    }
}
