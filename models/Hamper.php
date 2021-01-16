<?php
namespace kouosl\product\models;

use Yii;

/**
 * This is the model class for table "Hamper".
 *
 * @property int $id
 * @property int $productid
 * @property string $name
 * @property string $brand
 * @property string $comment
 * @property int $price
 * @property int $quentity
 * @property string $username
 * 
 */
class Hamper extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'hamper';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['name', 'brand', 'comment', 'price','productid', 'quentity', 'username', 'price'], 'required'],
            [['productid', 'quentity', 'price'], 'integer'],
            [['username', 'name', 'brand', 'comment'], 'string'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'productid' => 'Ürün ID',
            'name' => 'Ürün İsmi',
            'brand' => 'Marka',
            'comment' => 'Açıklama',
            'price' => 'Fiyat',
            'quentity' => 'Adet',
            'username' => 'Kullanıcı Adı',
            
        ];
    }
}