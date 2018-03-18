<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%contact_form}}".
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property string $phone
 * @property string $message
 * @property int $created_at
 * @property int $updated_at
 */
class ContactForm extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%contact_form}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'email', 'phone'], 'required'],
            [['message'], 'string'],
            [['name', 'email', 'phone'], 'string', 'max' => 255],
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
            'name' => Yii::t('app', 'Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone'),
            'message' => Yii::t('app', 'Message'),
        ];
    }

    public function behaviors()
    {
        return [TimestampBehavior::class];
    }
}
