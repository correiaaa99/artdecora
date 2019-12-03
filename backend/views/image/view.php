<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Image */
$this->title = 'Imagem';
$this->params['breadcrumbs'][] = ['label' => 'Images', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="image-view">
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idImage], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idImage], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tens a certeza que desejas eliminar esta imagem?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=> 'idImage',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'name',
                'label' => 'Imagem',
                'value'=> '@web/' . $model->name,
                'format' => ['image',['width'=>'60','height'=>'50']],
            ],
        ],
    ]) ?>

</div>
