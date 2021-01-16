<?php

namespace kouosl\product\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use kouosl\product\models\Product;

/**
 * ProductList represents the model behind the search form of `backend\models\Product`.
 */
class ProductList extends Product
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id'], 'integer'],
            [['name', 'comment', 'brand', 'price', 'stoch'], 'safe'],
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
        $query = Product::find();
        


        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
        
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'comment', $this->comment])
            ->andFilterWhere(['like', 'brand', $this->brand])
            ->andFilterWhere(['like', 'price', $this->price])
            ->andFilterWhere(['>', 'stoch', 0]);

        return $dataProvider;
    }
}
