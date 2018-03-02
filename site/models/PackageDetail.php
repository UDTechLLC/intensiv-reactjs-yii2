<?php

namespace app\models;

use Yii;
use yii\behaviors\TimestampBehavior;

/**
 * This is the model class for table "{{%package_detail}}".
 *
 * @property int $id
 * @property string $username
 * @property string $email
 * @property string $phone
 * @property int $pack_id
 * @property string $discount_code
 * @property string $created_at
 * @property string $updated_at
 * @property Package $pack
 */
class PackageDetail extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%package_detail}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['username', 'email', 'phone', 'pack_id'], 'required'],
            [['pack_id'], 'integer'],
            [['created_at', 'updated_at'], 'integer'],
            [['username', 'email', 'phone', 'discount_code'], 'string', 'max' => 255],
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
            'id' => Yii::t('app', 'ID'),
            'username' => Yii::t('app', 'User Name'),
            'email' => Yii::t('app', 'Email'),
            'phone' => Yii::t('app', 'Phone Number'),
            'pack_id' => Yii::t('app', 'Pack'),
            'discount_code' => Yii::t('app', 'Discount Code'),
            'created_at' => Yii::t('app', 'Created At'),
            'updated_at' => Yii::t('app', 'Updated At'),
        ];
    }

    public function getPack()
    {
        return $this->hasOne(Package::class, ['id' => 'pack_id']);
    }
}
