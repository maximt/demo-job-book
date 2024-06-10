<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <?= $form->field($model, 'firstname')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'surname')->textInput(['maxlength' => true]) ?>
        <?= $form->field($model, 'lastname')->textInput(['maxlength' => true]) ?>
    </div>

    <div class="row">
        <div class="col-2">
            <?= $form->field($model, 'birthday')->input('date') ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'gender')->dropDownList(
                ['0' => 'Мужской', '1' => 'Женский']
            ) ?>
        </div>
    </div>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>