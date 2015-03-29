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
     * @param string  $password            Password
     * @param Closure $encryptionAlgorithm Encryption Algorithm
     *
     * @return boolean Match or not
     */
    public function comparePassword($password, $encryptionAlgorithm = null)
    {
        if (empty($encryptionAlgorithm)) {
            $encryptionAlgorithm = function ($password) {

                return \FlexUser\Model\User::encryptPassword($password);
            };
        }

        return $this->password === $encryptionAlgorithm($password);
    }

    /**
     * Encrypt Password
     *
     * @param string $password Password
     *
     * @return string md5
     */
    public static function encryptPassword($password)
    {
        return md5(sha1($password).$password);
    }
}
