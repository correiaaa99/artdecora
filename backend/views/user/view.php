<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\User */

$this->title = $model->username;
$this->params['breadcrumbs'][] = ['label' => 'Utilizadores', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="user-view">
    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idUser], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idUser], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tens a certeza que desejas eliminar este utilizador?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=> 'idUser',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'username',
                'label' => 'Username',
            ],
            [
                'attribute'=> 'name',
                'label' => 'Nome',
            ],
            [
                'attribute'=> 'surname',
                'label' => 'Apelido',
            ],
            [
                'attribute'=> 'photo',
                'label' => 'Foto',
            ],
            [
                'attribute'=> 'birth_date',
                'label' => 'Data de nascimento',
            ],
            [
                'attribute'=> 'telephone',
                'label' => 'Telemóvel',
            ],
            [
                'attribute'=> 'email',
                'label' => 'Email',
            ],
        ],
    ]) ?>

</div>
