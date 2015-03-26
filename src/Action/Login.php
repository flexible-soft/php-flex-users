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
    /**
     * Run this action
     * @param  string  $email      Email
     * @param  string  $password   Password
     * @param  Closure $callback   Password
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
        $user = User::findByEmail($email);

        // compare password
        if (!$user->comparePassword($password)) {
            return $callback(Boom::unauthorized('Username or password does not match.'), null);
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