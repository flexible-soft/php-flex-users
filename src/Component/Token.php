<?php

namespace FlexUser\Component;

/**
 * Token Component.
 */
class Token extends \FlexBase\Component
{
    /**
     * Create token.
     *
     * @param FlexUser\Model\User $user User
     *
     * @return string Access Token
     */
    public static function create($user)
    {
        return md5($user->id);
    }
}
