<?php

use yii\grid\GridView;
use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\Employee $model */

$this->title = $model->getFullname();
$this->params['breadcrumbs'][] = ['label' => 'Сотрудники', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="employee-view">
    <div class="row">
        <h1><?= Html::encode($this->title) ?></h1>

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
                'firstname',
                'surname',
                'lastname',
                'birthday:date',
                'gender',
                'created_at:datetime',
                'updated_at:datetime',
                'createdBy.username',
                'updatedBy.username',
            ],
        ]) ?>
    </div>

    <div class="row">
        <h2>Место работы</h2>

        <div class="d-flex justify-content-end">
            <?= Html::a('Добавить место работы', ['employee-job/create', 'employee_id' => $model->id], ['class' => 'btn btn-secondary']) ?>
        </div>

        <?php Pjax::begin(['id' => 'pjax-employee-jobs']); ?>

        <?= GridView::widget([
            'dataProvider' => $jobsDataProvider,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'company',
                'begin_at:date',
                'end_at:date',
                [
                    'class' => 'yii\grid\ActionColumn',
                    'contentOptions' => ['class' => 'text-end', 'style' => 'width: 1%; white-space: nowrap;'],
                    'headerOptions' => ['class' => 'text-end', 'style' => 'width: 1%; white-space: nowrap;'],
                    'template' => '{view} {update} {delete}',
                    'urlCreator' => function ($action, $model, $key, $index) {
                        if ($action === 'view') {
                            return ['employee-job/view', 'id' => $model->id];
                        }
                        if ($action === 'update') {
                            return ['employee-job/update', 'id' => $model->id];
                        }
                        if ($action === 'delete') {
                            return ['employee-job/delete', 'id' => $model->id];
                        }
                    }
                ],
            ],
        ]) ?>

        <?php Pjax::end(); ?>
    </div>
</div>