<?php

use Illuminate\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Passwords\CanResetPassword;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Contracts\Auth\CanResetPassword as CanResetPasswordContract;

/**
 * FlexActiveRecord.
 */
class FlexActiveRecord extends Model
{
    public $table = __CLASS__;
    public static $model = array();

    /**
     * Static Model.
     *
     * @param string $className Class name
     *
     * @return FlexActiveRecord Active Record Model
     */
    public static function staticModel($className = __CLASS__)
    {
        if (!isset(self::$model[$className])) {
            self::$model[$className] = new $className();
        }

        return self::$model[$className];
    }

    /**
     * Table Name.
     */
    public function tableName()
    {
        return '{{'.$this->table.'}}';
    }

    /**
     * Find One model by attributes.
     *
     * @param array $attributes Attributes
     *
     * @return FlexActiveRecord Active Record
     */
    public function findByAttributes($attributes, $condition = '', $params = array())
    {
        return parent::where($attributes)->first();
    }
}
