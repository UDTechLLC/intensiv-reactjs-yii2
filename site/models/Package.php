<?php

namespace app\models;

use Yii;
use yii\helpers\Html;

/**
 * This is the model class for table "{{%package}}".
 *
 * @property int $id
 * @property string $name
 * @property string $description
 * @property double $price
 * @property double $sale_price
 * @property double $sale_percent
 * @property string $image
 * @property int $section
 * @property int $sort_index
 * @property string $start_date
 * @property int $required_test_lesson
 * @property int $hide_button
 *
 * @property string $price_formatted
 * @property string $sale_price_formatted
 * @property string $full_price_formatted
 * @property string $sale_percent_formatted
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
            [['price', 'sale_price', 'sale_percent'], 'number'],
            [['section', 'sort_index'], 'integer'],
            [['start_date'], 'safe'],
            [['name', 'image'], 'string', 'max' => 255],
            [['required_test_lesson', 'hide_button'], 'boolean'],
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
            'sale_price' => Yii::t('app', 'Sale Price'),
            'sale_percent' => Yii::t('app', 'Sale Percent'),
            'image' => Yii::t('app', 'Image'),
            'section' => Yii::t('app', 'Section'),
            'sort_index' => Yii::t('app', 'Sort'),
            'start_date' => Yii::t('app', 'Start Date'),
            'required_test_lesson' => Yii::t('app', 'Test Lesson'),
            'hide_button' => Yii::t('app', 'Hide button "Boka nu"'),
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
                [
                    Yii::$app->formatter->decimalSeparator.'00',
                    ':00',
                ],
                '',
                Yii::$app->formatter->asCurrency($this->price)
        );
    }

    public function getSale_price_formatted()
    {
        return str_replace(
            [
                Yii::$app->formatter->decimalSeparator.'00',
                ':00',
            ],
            '',
            Yii::$app->formatter->asCurrency($this->sale_price)
        );
    }

    public function getFull_price_formatted()
    {
        $html = '';
        if($this->sale_price){
            $html = Html::tag('span', $this->price_formatted, ['class' => 'cross']) . $this->sale_price_formatted;
        }else{
            if($this->price){
                $html = $this->price_formatted;
            }
        }
        return $html;
    }

    public function getSale_percent_formatted()
    {
        return $this->sale_percent ? Html::tag('span', $this->sale_percent . '%', ['class' => 'sale-percent']) : '';
    }
}
