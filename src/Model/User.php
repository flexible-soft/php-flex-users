<?php

namespace FlexUser\Model;

/**
 * User model
 */
class User extends \FlexActiveRecord
{
    public $table = 'user';

    public function findByEmail($email)
    {
        return new User();
    }

    public function comparePassword($password)
    {
        return true;
    }
}
