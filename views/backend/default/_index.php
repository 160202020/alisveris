<?php
use kouosl\product\models\Hamper;
use kouosl\product\models\Product;
use kouosl\theme\widgets\Portlet;
use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Ürün Konrol Sayfası';


$this->params['breadcrumbs'][] = $this->title;
?>
    <div style="text-align:center"> 
        <?php
            $data['title'] = Html::encode($this->title);  
        ?>
    </div>

<div class="site-contact">
    <h1><?= Html::encode($this->title) ?></h1>

 <h3>Ürünler</h3>

<?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        
        <?= Html::a('Ürün Ekle', ['create'], ['class' => 'btn btn-success']) ?>

    </p>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
                'filterModel' => $searchModel,

        
       'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            
            'name',
            'brand',
            'comment',
            'price',
            'stoch',
            
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
    <?php Pjax::end(); ?>


    <h1>Müşteri Sepetleri</h1>
            <table class="table table-striped table-dark table-bordered">
                <thead>
                    <tr>
                        <th>Kullanıcı Adı</th>
                        <th>Ürün Id</th>
                        <th>Ürün Adedi</th>
                        
                    </tr>
                </thead>
                <tbody>
                    <?php 
                  foreach ($tablo2 as $key => $value) {
                      echo "<tr><th>".$value["username"]."</th><th>".$value["productid"]."</th><th>".$value["quentity"]."</th></tr>";
                  }
                  ?>
                </tbody>
            </table>
        </div>


                
</div>





