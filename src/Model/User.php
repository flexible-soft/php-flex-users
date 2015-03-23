<?php

namespace FlexUser\Model;

/**
 * User model
 */
class User extends \FlexActiveRecord
{
    public $table = 'flex_user';

    public function createUser($attributes = array())
    {
        return $attributes;
    }
}
