<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    use HasFactory;

   protected $fillable = [
    'title', 'address', 'content', 'rating', 'place_id', 'user_id',
    'time_of_day', 'ambiance', 'activity_type', 'crowd_level'
];

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function place() {
        return $this->belongsTo(Place::class);
    }

    public function photos() {
        return $this->hasMany(Photo::class);
    }

    public function comments() {
        return $this->hasMany(Comment::class);
    }

    public function favorites() {
        return $this->hasMany(Favorite::class);
    }

    public function likes()
{
    return $this->belongsToMany(User::class, 'experience_user');
}
}