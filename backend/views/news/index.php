<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel backend\models\search\NewsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Yangiliklarni boshqarish';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="news-index">

    <h1></h1>

    <p>
        <?= Html::a('Yangilik qo\'shish', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'id',
            [
                'attribute' => 'title',
                'value' =>  function($model){
                    return substr($model->title,0,60).'...';
                },
            ],
            [
                'attribute' => 'content',
                'value' =>  function($model){
                    return substr($model->content,0,60).'...';
                },
            ],
            'language',
            'created_date',
            //'image',
            //'tags_id',
            //'user_id',
            //'views',
            //'status',
            //'category_id',
            //'priority',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>


</div>
