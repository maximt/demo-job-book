<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var app\models\EmployeeJob $model */
/** @var app\models\Employee $model_employee */

$this->title = 'Редактировать место работы';

$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = ['label' => $model_employee->getFullname(), 'url' => ['employee/view', 'id' => $model_employee->id]];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-job-update">

    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?= $model_employee->getFullname() ?></h3>

    <?= $this->render('_form', [
        'model' => $model,
        'model_employee' => $model_employee
    ]) ?>

</div>