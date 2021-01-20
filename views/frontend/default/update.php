<?php

use yii\helpers\Html;



$this->title = 'Sepete Ekle: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Product', 'url' => ['index']];
//$this->params['breadcrumbs'][] = ['label' => $model->id, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'AddHamper';
?>
<div class="product-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('hamperadd', [
        'model' => $model,
        'model3' => $model3,
    ]) ?>

</div>
