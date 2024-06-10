<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var app\models\EmployeeJob $model */
/** @var app\models\Employee $model_employee */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="employee-job-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'employee_id')->hiddenInput([
        'value' => $model_employee->id
    ])->label(false) ?>

    <?= $form->field($model, 'begin_at')->textInput() ?>

    <?= $form->field($model, 'end_at')->textInput() ?>

    <?= $form->field($model, 'company')->textInput(['maxlength' => true]) ?>

    <div class="form-group">
        <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>