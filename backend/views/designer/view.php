<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Designer */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Designers', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="designer-view">
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idDesigner], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idDesigner], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tens a certeza que desejas eliminar este designer?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=> 'idDesigner',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'name',
                'label' => 'Nome',
            ],
        ],
    ]) ?>

</div>
