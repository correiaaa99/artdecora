<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Category */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Categorias', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="category-view">


    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idCategory], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idCategory], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tens a certeza que desejas eliminar esta categoria?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=> 'idCategory',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'name',
                'label' => 'Nome',
            ],
        ],
    ]) ?>

</div>
