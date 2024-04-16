<?php

namespace App\Helpers;

class Role
{
    public static function check(string $role): bool
    {
        /** @var \App\Models\Account $user * */
        $user = auth()->user();
        $roles = explode('|', $role);

        if (!in_array($user->role(), $roles)) {
            return false;
        }

        return true;
    }
}
