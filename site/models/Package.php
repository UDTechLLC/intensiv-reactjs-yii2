<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%package}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property string $image
 * @property int $section
 * @property int $sort_index
 * @property string $start_date
 * @property int $required_test_lesson
 *
 * @property string $price_formatted
 * @property string $display_name
 */
class Package extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%package}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name', 'section'], 'required'],
            [['description'], 'string'],
            [['price'], 'number'],
            [['section', 'sort_index'], 'integer'],
            [['start_date'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['required_test_lesson'], 'boolean'],
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
            'description' => Yii::t('app', 'Description'),
            'price' => Yii::t('app', 'Price'),
            'image' => Yii::t('app', 'Image'),
            'section' => Yii::t('app', 'Section'),
            'sort_index' => Yii::t('app', 'Sort'),
            'start_date' => Yii::t('app', 'Start Date'),
            'required_test_lesson' => Yii::t('app', 'Test Lesson'),
        ];
    }

    public function beforeValidate()
    {
        if (!empty($this->start_date) && !is_numeric($this->start_date)) {
            $this->start_date = strtotime($this->start_date);
        }
        return parent::beforeValidate();
    }

    public function getDisplay_name()
    {
        $formatPrice = $this->price_formatted;
        return $this->name.' ('.str_replace('&nbsp;', ' ', $formatPrice).')';
    }

    public static function getList()
    {
        $ret = [];
        $all = self::find()->orderBy('name')->indexBy('id')->all();
        foreach ($all as $id => $item) {
            $ret[$id] = $item->display_name;
        }
        return $ret;
    }

    public function getPrice_formatted()
    {
        return str_replace(
                Yii::$app->formatter->decimalSeparator.'00',
                '',
                Yii::$app->formatter->asCurrency($this->price)
        );
    }
}
