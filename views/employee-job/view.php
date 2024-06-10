<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = 'Место работы';

$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['employee/index']];
$this->params['breadcrumbs'][] = ['label' => $model_employee->getFullname(), 'url' => ['employee/view', 'id' => $model_employee->id]];
$this->params['breadcrumbs'][] = $this->title;

\yii\web\YiiAsset::register($this);
?>
<div class="employee-job-view">
    <h1><?= Html::encode($this->title) ?></h1>
    <h3><?= $model_employee->getFullname() ?></h3>

    <div class="d-flex justify-content-end py-2">
        <?= Html::a('Изменить', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => Yii::t('yii', 'Are you sure you want to delete this item?'),
                'method' => 'post',
            ],
        ]) ?>
    </div>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'begin_at:date',
            'end_at:date',
            'company',
            'created_at:datetime',
            'updated_at:datetime',
            'createdBy.username',
            'updatedBy.username',
        ],
    ]) ?>

</div>