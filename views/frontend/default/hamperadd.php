<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

?>
 <p>
        
         <?= Html::a('Anasayfa', ['#'], ['class' => 'btn btn-success']) ?>

    </p>
<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
   

    <?= $form->field($model3, 'name')->textInput(['maxlength' => true, 'disabled'=> 'disabled']) ?>

    <?= $form->field($model3, 'brand')->textInput(['maxlength' => true, 'disabled'=> 'disabled']) ?>

    <?= $form->field($model3, 'comment')->textInput(['maxlength' => true, 'disabled'=> 'disabled']) ?>

    <?= $form->field($model3, 'price')->textInput(['maxlength' => true, 'disabled'=> 'disabled']) ?>

    <?= $form->field($model3, 'quentity') ?>








    <div class="form-group">
        <?= Html::submitButton('Kaydet', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
