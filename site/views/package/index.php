<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\PackageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = Yii::t('app', 'Packages');
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="package-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a(Yii::t('app', 'Create Package'), ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            'id',
            'name',
            [
                'attribute' => 'description',
                'format' => 'html',
            ],
            'price:currency',
            'sale_price:currency',
            'sale_percent',
            'image',
            [
                'attribute' => 'section',
                'value' => function($data) {
                    $sections = \app\models\Sections::getList();
                    if (isset($sections[$data['section']])) {
                        return $sections[$data['section']];
                    }
                    return $data['section'];
                },
                'filter' => \app\models\Sections::getList(),
            ],
            [
                'attribute' => 'start_date',
                'format' => 'datetime',
                'filter' => false,
            ],
            [
                'attribute' => 'required_test_lesson',
                'format' => 'boolean',
                'headerOptions' => [
                    'style' => 'width:50px'
                ],
            ],
            [
                'attribute' => 'sort_index',
                'filter' => false,
                'headerOptions' => [
                    'style' => 'width:50px'
                ],
            ],

            [
                'class' => 'yii\grid\ActionColumn',
                'template' => '{update} {delete}',
            ],
        ],
    ]); ?>
    <?php Pjax::end(); ?>
</div>
