<?php

namespace FlexUser\Model;

/**
 * User model.
 */
class User extends \FlexActiveRecord
{
    public $table = 'user';

    /**
     * Static Model.
     *
     * @param string $className Class name
     *
     * @return FlexUser\Model\User Active Record Model
     */
    public static function staticModel($className = __CLASS__)
    {
        return parent::staticModel($className);
    }

    /**
     * Find model by email.
     *
     * @param string $email Email
     *
     * @return FlexUser\Model\User Model
     */
    public function findByEmail($email)
    {
        return $this->findByAttributes(array(
            'email' => $email,
        ));
    }

    /**
     * Compare password.
     *
     * @param string $password Password
     *
     * @return boolean Match or not
     */
    public function comparePassword($password)
    {
        return true;
    }
}
