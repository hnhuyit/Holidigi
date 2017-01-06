<?php

namespace common\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\SiteOwner;

/**
 * SiteOwnerSearch represents the model behind the search form about `common\models\SiteOwner`.
 */
class SiteOwnerSearch extends SiteOwner
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'create_by', 'status', 'agency_id', 'plan_id', 'bill_id', 'created_at', 'updated_at'], 'integer'],
            [['name', 'des', 'avatar', 'website'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = SiteOwner::find();

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
            'create_by' => $this->create_by,
            'status' => $this->status,
            'agency_id' => $this->agency_id,
            'plan_id' => $this->plan_id,
            'bill_id' => $this->bill_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'des', $this->des])
            ->andFilterWhere(['like', 'avatar', $this->avatar])
            ->andFilterWhere(['like', 'website', $this->website]);

        return $dataProvider;
    }
}
