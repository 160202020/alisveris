<?php
use 160202020\theme\helpers\Html;
use 160202020\theme\widgets\Portlet;
use yii\bootstrap\ActiveForm;
use 160202020\product\models\Hamper;
use 160202020\product\models\Product;
use 160202020\product\Module;
use 160202020\site\models\Setting;


use yii\grid\GridView;
use yii\widgets\Pjax;

$this->title = 'Ürünler';
$data['title'] = Html::encode($this->title);
$this->params['breadcrumbs'][] = $this->title; ?>


<div class="site-contact">
<h1>  <?php 
            $lang = yii::$app->session->get('lang');
      \Yii::$app->language = $lang;
      yii::$app->session->set('lang',$lang);
      \Yii::$app->language = 'tr-TR';
            echo Module::t('product','Ürünler');
            ?> </h1>


<?php $form = ActiveForm::begin(['id' => 'contact-form']); ?>    

<?php Pjax::begin(['id' => 'product']); ?>


    <?= GridView::widget([
        'dataProvider' => $dataProviderProduct,
        'filterModel' => $searchModelProduct,

        'columns' => [
                 ['class' => 'yii\grid\SerialColumn'],
            'id',          
            'name',
            'brand',
            'comment',
            'price',
            'stoch',
            ['class' => 'yii\grid\ActionColumn',
            'template' => ' {myButton}',
                'buttons' =>  [
                  
                   'myButton'=> function ($url, $model, $key) {
                   
                        return Html::a('Sepete Ekle', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']);
                    }
                            ]  
            ],
            
        ],
    ]); ?>
   
    <?php Pjax::end(); ?>
    <?php ActiveForm::end(); ?>

<br>

<h1>Sepetimdeki Ürünler</h1>

    <?php Pjax::begin(['id' => 'hamper']); ?>


<?= GridView::widget([
    'dataProvider' => $dataProviderHamper,
    'filterModel' => $searchModelHamper,

    'columns' => [
             ['class' => 'yii\grid\SerialColumn'],
        'id',    
        'productid',
        'name',
        'brand',
        'comment',
        'price',
        'quentity',
        ['class' => 'yii\grid\ActionColumn',
        'template' => '{myButton2}',

        'buttons' =>  [
                  
            'myButton2'=> function ($url, $model, $key) {
            
                 return Html::a('Sepetten Çıkar', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-danger',
                    'data' => [
                        'confirm' => 'Ürünü kaldırmak istediğinize emin misiniz?',
                        'method' => 'post',
                    ],
                ]);
             }
                     
         ],
        
        ],     
        
    ],
]); ?>

<?php Pjax::end(); ?>


 




</div>