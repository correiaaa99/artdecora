<?php
use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel backend\models\ImageSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$this->title = 'Imagens';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="image-index">
    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>
    <p>
        <?= Html::a('Adicionar imagem', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute'=> 'idImage',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'name',
                'label' => 'Imagem',
                'format' => 'html',

                'value' => function ($model) {

                    return Html::img('@web/' . $model['name'],
                        ['width' => '100px']);
    
                },
            ],
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{update} {delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
