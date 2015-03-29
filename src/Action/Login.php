<?php

namespace FlexUser\Action;

use FlexUser\Model\User;
use FlexUser\Component\Token;
use FlexBase\Boom;

/**
 * Login action.
 */
class Login extends \FlexBase\Action
{
    public $encryptionAlgorithm = null;

    /**
     * Run this action.
     *
     * @param string  $email    Email
     * @param string  $password Password
     * @param Closure $callback Password
     *
     * @return FlexUser\Model\User User model
     */
    public function run($email, $password, $callback)
    {
        $before = $this->before;
        $after = $this->after;

        if ($before && ($success = $before($email, $password)) !== true) {
            return $callback($success, null);
        }

        // find user
        $user = User::staticModel()->findByEmail($email);
        if (empty($user)) {
            return $callback(Boom::unauthorized('Email or password does not match.'), null);
        }

        // compare password
        if (!$user->comparePassword($password, $this->encryptionAlgorithm)) {
            return $callback(Boom::unauthorized('Email or password does not match.'), null);
        }

        // create token
        $token = Token::create($user);

        $after && $this->after(array(
            'user'  => $user,
            'token' => $token,
        ));

        $callback(null, array(
            'user'  => $user,
            'token' => $token,
        ));
    }
}
