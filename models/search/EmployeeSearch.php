<?php

namespace app\models\search;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Employee;
use yii\db\Expression;

/**
 * EmployeeSearch represents the model behind the search form of `app\models\Employee`.
 */
class EmployeeSearch extends Employee
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'gender', 'created_by', 'updated_by', 'created_at', 'updated_at'], 'integer'],
            [['firstname', 'surname', 'lastname', 'birthday'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        // $query = Employee::find();

        // add conditions that should always apply here

        $query = Employee::find()
        ->select([
            'employee.*',
            new Expression('COUNT(employee_jobs.id) AS job_count')
        ])
        ->leftJoin('employee_jobs', 'employee.id = employee_jobs.employee_id')
        ->groupBy('employee.id');
        //->orderBy(new Expression('job_count ASC'));

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => [
                'attributes' => [
                    'firstname',
                    'surname',
                    'lastname',
                    'job_count' => [
                        'asc' => ['job_count' => SORT_ASC],
                        'desc' => ['job_count' => SORT_DESC],
                        'label' => 'Job Count',
                        'default' => SORT_DESC, // Set default sorting direction
                    ],
                ],
            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'birthday' => $this->birthday,
            'gender' => $this->gender,
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'firstname', $this->firstname])
            ->andFilterWhere(['like', 'surname', $this->surname])
            ->andFilterWhere(['like', 'lastname', $this->lastname]);

        return $dataProvider;
    }
}
