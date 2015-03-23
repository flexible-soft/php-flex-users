<?php

/**
 * FlexActiveRecord
 */
class FlexActiveRecord extends \CActiveRecord
{
    public function tableName()
    {
        return '{{'.$this->table.'}}';
    }
}
