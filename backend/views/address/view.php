<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\Address */

$this->title = $model->address_name;
$this->params['breadcrumbs'][] = ['label' => 'Endereços', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="address-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idAddress], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idAddress], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tens a certeza que deseja eliminar este endereço?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=> 'idAddress',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'address_name',
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
        ],
    ]) ?>

</div>
