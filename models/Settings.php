<?php

namespace pendalf89\settings\models;

use Yii;

/**
 * This is the model class for table "settings".
 *
 * @property string $key
 * @property string $value
 */
class Settings extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'settings';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['key', 'value'], 'required'],
            [['value'], 'string'],
            [['key'], 'string', 'max' => 255]
        ];
    }
}
