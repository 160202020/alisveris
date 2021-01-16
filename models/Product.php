<?php

namespace kouosl\product\models;

use Yii;
/**
 * This is the model class for table "product".
 *
 * @property int $id
 * @property string $name
 * @property string $brand
 * @property string $comment
 * @property int $price
 * @property int $stoch
 *

 */

 class Product extends \yii\db\ActiveRecord
 {
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'product';
    }

     /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'brand', 'comment', 'price', 'stoch'], 'required'],
            [['name', 'brand', 'comment'], 'string'],
            [['price', 'stoch'], 'integer'],
            
        ];
    }

     /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'name' => 'Ürün Adı',
            'brand' => 'Marka',
            'comment' => 'Açıklama',
            'price' => 'Fiyat',
            'stoch' => 'Stok',
        ];
    }


 }