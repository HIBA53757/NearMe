<?php

namespace App\Policies;

use App\Models\User;

class AdminPolicy
{
   
    public function accessAdmin(User $user): bool
    {

        return $user->role === 'admin' && !$user->banned_at;
    }

   
    public function manageUsers(User $user, User $target): bool
    {
        return $user->role === 'admin' && $user->id !== $target->id;
    }
}