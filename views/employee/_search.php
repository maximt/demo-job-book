<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\search\EmployeeSearch $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
        'options' => [
            'data-pjax' => 1
        ],
    ]); ?>

    <div class="row">
        <div class="col">
            <?= $form->field($model, 'firstname') ?>
        </div>

        <div class="col">
            <?= $form->field($model, 'surname') ?>
        </div>

        <div class="col">
            <?= $form->field($model, 'lastname') ?>
        </div>
    </div>
    <div class="row">
        <div class="col-2">
            <?= $form->field($model, 'birthday')->input('date') ?>
        </div>
        <div class="col-2">
            <?= $form->field($model, 'gender')->dropDownList(
                ['' => '', '0' => 'Мужской', '1' => 'Женский']
            ) ?>
        </div>
    </div>
    <div class="form-group">
        <?= Html::submitButton('Поиск', ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сброс', ['index'], ['class' => 'btn btn-outline-secondary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>