<?php

namespace Corp\Policies;

use Corp\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use function Sodium\crypto_box_publickey_from_secretkey;

class PermissionPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
      
    }

    public function change(User $user)
    {
        return $user->canDo('EDIT_USERS');
    }
}
