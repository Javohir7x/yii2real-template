<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model backend\models\Categories */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="categories-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'title')->textInput()->label('Kategoriya nomi') ?>

    <?= $form->field($model, 'description')->textarea(['rows' => 2])->label('Kategoriya haqida') ?>

    <?= $form->field($model, 'language')->dropDownList([
        'uz' => 'O\'zbek (Lotin)',
        'oz' => 'O\'zbek (Kril)',
        'ru' => 'Русскый',
    ])->label('Kategoriya tili')  ?>


    <div class="form-group">
        <?= Html::submitButton('Saqlash', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
