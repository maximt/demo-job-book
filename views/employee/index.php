<?php

use app\models\Employee;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use yii\widgets\ListView;
use yii\widgets\Pjax;

/** @var yii\web\View $this */
/** @var app\models\search\EmployeeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->title = 'Сотрудники';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="employee-index">

    <h1><?= Html::encode($this->title) ?></h1>



    <?php Pjax::begin(); ?>
    <?php echo $this->render('_search', ['model' => $searchModel]); ?>

    <div class="d-flex justify-content-end">
        <?= Html::a('Добавить сотрудника', ['create'], ['class' => 'btn btn-secondary']) ?>
    </div>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        // 'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'firstname',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->firstname, ['employee/view', 'id' => $model->id]);
                },
            ],
            [
                'attribute' => 'surname',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->surname, ['employee/view', 'id' => $model->id]);
                },
            ],
            [
                'attribute' => 'lastname',
                'format' => 'raw',
                'value' => function ($model) {
                    return Html::a($model->lastname, ['employee/view', 'id' => $model->id]);
                },
            ],
            // 'birthday',
            [
                'attribute' => 'job_count',
                'label' => 'Записей',
            ],
            [
                'class' => ActionColumn::class,
                'contentOptions' => ['class' => 'text-end', 'style' => 'width: 1%; white-space: nowrap;'],
                'headerOptions' => ['class' => 'text-end', 'style' => 'width: 1%; white-space: nowrap;'],
                'urlCreator' => function ($action, Employee $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                },
            ],
        ]
    ]) ?>

    <?php Pjax::end(); ?>

</div>