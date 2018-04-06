<?php

use kartik\datetime\DateTimePicker;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Package */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="package-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'price')->textInput(['type' => 'number', 'min' => 0, 'step' => 1]) ?>

    <?= $form->field($model, 'sale_price')->textInput(['type' => 'number', 'min' => 0, 'step' => 1]) ?>

    <?= $form->field($model, 'sale_percent')->textInput(['type' => 'number', 'min' => 0, 'step' => 1]) ?>

    <?= $form->field($model, 'image')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'section')->dropDownList(\app\models\Sections::getList()) ?>

    <?= $form->field($model, 'sort_index')->textInput(['type' => 'number', 'step' => 1]) ?>

    <?= $form->field($model, 'start_date')
        ->widget(DateTimePicker::class, [
            'options' => ['placeholder' => 'Enter date and time ...'],
            'pluginOptions' => [
                'autoclose' => true
            ]
        ]) ?>

    <?= $form->field($model, 'required_test_lesson')->checkbox() ?>

    <div class="form-group">
        <?= Html::submitButton(Yii::t('app', 'Save'), ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
