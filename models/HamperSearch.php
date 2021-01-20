<?php

namespace 160202020\product\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use 160202020\product\models\Hamper;
use 160202020\user\models\User;
use Yii;

/**
 * HamperSearch represents the model behind the search form of `backend\models\Hamper`.
 */
class HamperSearch extends Hamper
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'comment', 'brand', 'price', 'productid', 'quentity', 'username'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
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
        $query = Hamper::find();
        

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
    ;
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);
        $username =  Yii::$app->user->identity->username;

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['like', 'username', $username]);
            

        return $dataProvider;
    }
}
