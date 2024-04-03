<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Cronograma;

/**
 * CronogramaSearch represents the model behind the search form of `app\models\Cronograma`.
 */
class CronogramaSearch extends Cronograma
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['materia', 'hora_inicial', 'hora_final'], 'safe'],
            [['feito'], 'boolean'],
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
        $query = Cronograma::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
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
            'hora_inicial' => $this->hora_inicial,
            'hora_final' => $this->hora_final,
            'feito' => $this->feito,
        ]);

        $query->andFilterWhere(['ilike', 'materia', $this->materia]);

        return $dataProvider;
    }
}
