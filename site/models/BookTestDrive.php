<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * @property int $id
 * @property string $name
 * @property string $city
 * @property string $mobile
 * @property string $month
 * @property int $created_at
 * @property int $updated_at
 */
class BookTestDrive extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%test_drive}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['month', 'city', 'name', 'mobile'], 'required'],
            [['month', 'city', 'name', 'mobile'], 'string', 'max' => 255],
            [['created_at', 'updated_at'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'name' => Yii::t('app', 'Personnummer'),
            'mobile' => Yii::t('app', 'Mobilnummer'),
            'month' => Yii::t('app', 'Välj månad'),
            'city' => Yii::t('app', 'Välj ort'),
        ];
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }
}
