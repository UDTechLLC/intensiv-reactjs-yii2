<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "header_form".
 *
 * @property int $id
 * @property string $place
 * @property string $packet
 * @property string $license
 * @property string $phone
 * @property int $created_at
 * @property int $updated_at
 */
class HeaderForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'header_form';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['phone'], 'required'],
            [['created_at', 'updated_at'], 'integer'],
            [['place', 'packet', 'license', 'phone'], 'string', 'max' => 255],
        ];
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'place' => 'Place',
            'packet' => 'Packet',
            'license' => 'License',
            'phone' => 'Phone',
            'created_at' => 'Created At',
            'updated_at' => 'Updated At',
        ];
    }
}
