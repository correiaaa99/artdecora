<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\AddressSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Endereços';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="address-index">


    <p>
        <?= Html::a('Criar endereço', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=> 'idAddress',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'name',
                'label' => 'Endereço',
            ],
            [
                'attribute'=> 'city',
                'label' => 'Cidade',
            ],
            [
                'attribute'=> 'zip_code',
                'label' => 'Código Postal',
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
