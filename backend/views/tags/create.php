<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model backend\models\Tags */

$this->title = 'Yangi teg yaratish';
$this->params['breadcrumbs'][] = ['label' => 'Tags', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tags-create">

    <h1></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
