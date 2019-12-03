<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\widgets\Pjax;
/* @var $this yii\web\View */
/* @var $searchModel app\models\DesignerprojectSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Designers do projeto: ' . $projeto;
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="designerproject-index">
    <p>
        <?= Html::a('Adicionar designer', ['create'], ['class' => 'btn btn-primary']) ?>
    </p>

    <?php Pjax::begin(); ?>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            [
                'attribute' => 'name', //To display called value,
                'value' => 'designer.name',
                'label' => 'Designer',
            ],
            
            ['class' => 'yii\grid\ActionColumn',
            'template' => '{delete}',
            ],
        ],
    ]); ?>

    <?php Pjax::end(); ?>

</div>
