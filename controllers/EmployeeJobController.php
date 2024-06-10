<?php

namespace app\controllers;

use app\models\Employee;
use app\models\EmployeeJob;
use app\models\EmployeeJobSearch;
use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * EmployeeJobController implements the CRUD actions for EmployeeJob model.
 */
class EmployeeJobController extends Controller
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'access' => [
                    'class' => AccessControl::class,
                    'rules' => [
                        [
                            'allow' => true,
                            'roles' => ['@'],
                        ],
                    ],
                ],
                'verbs' => [
                    'class' => VerbFilter::class,
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Creates a new EmployeeJob model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($employee_id)
    {
        $model_employee = $this->findEmployeeModel($employee_id);
        $model = new EmployeeJob();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Сохранено');
                return $this->redirect(['employee/view', 'id' => $employee_id]);
            }
            Yii::$app->session->setFlash('danger', 'Не удалось создать элемент');
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
            'model_employee' => $model_employee
        ]);
    }

    /**
     * Updates an existing EmployeeJob model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);
        $model_employee = $this->findEmployeeModel($model->employee_id);

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                Yii::$app->session->setFlash('success', 'Сохранено');
                return $this->redirect(['employee/view', 'id' => $model->employee_id]);
            }
            Yii::$app->session->setFlash('danger', 'Не удалось редактировать элемент');
        }

        return $this->render('update', [
            'model' => $model,
            'model_employee' => $model_employee
        ]);
    }

    /**
     * Deletes an existing EmployeeJob model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $employee_id = $model->employee_id;
        if ($model->delete()) {
            Yii::$app->session->setFlash('success', 'Удалено');
        } else {
            Yii::$app->session->setFlash('danger', 'Не удалось элемент');
        }
        return $this->redirect(['employee/view', 'id' => $employee_id]);
    }

    /**
     * Finds the EmployeeJob model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return EmployeeJob the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = EmployeeJob::findOne(['id' => $id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    protected function findEmployeeModel($employee_id)
    {
        if (($model = Employee::findOne(['id' => $employee_id])) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

}
