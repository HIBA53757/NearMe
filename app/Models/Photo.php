<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photo extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'experience_id',
    ];

    public function experience() {
        return $this->belongsTo(Experience::class);
    }
}