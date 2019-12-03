<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DesignerSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Designers';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designer-index">
    <?php if (Yii::$app->session->hasFlash('erro')): ?>
    <div class="alert alert-error alert-dismissable">
         <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
         <h4><i class="icon fa fa-close"></i>Erro</h4>
         <?= Yii::$app->session->getFlash('erro') ?>
    </div>
    <?php endif; ?>
    <p>
        <?= Html::a('Criar Designer', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=> 'idDesigner',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'name',
                'label' => 'Nome',
            ],
            [
                'attribute'=> 'email',
                'label' => 'Email',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
