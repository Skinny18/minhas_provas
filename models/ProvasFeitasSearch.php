<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\ProvasFeitas;

/**
 * ProvasFeitasSearch represents the model behind the search form of `app\models\ProvasFeitas`.
 */
class ProvasFeitasSearch extends ProvasFeitas
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'acertos', 'questoes'], 'integer'],
            [['assunto', 'data'], 'safe'],
            [['porcentagem'], 'number'],
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
        $query = ProvasFeitas::find();

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
            'data' => $this->data,
            'acertos' => $this->acertos,
            'questoes' => $this->questoes,
            'porcentagem' => $this->porcentagem,
        ]);

        $query->andFilterWhere(['ilike', 'assunto', $this->assunto]);

        return $dataProvider;
    }
}
