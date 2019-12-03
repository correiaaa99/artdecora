<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model backend\models\Project */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => 'Projetos', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="project-view">

    <p>
        <?= Html::a('Atualizar', ['update', 'id' => $model->idProject], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Eliminar', ['delete', 'id' => $model->idProject], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Tens a certeza que desejas eliminar este projeto?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            [
                'attribute'=> 'idProject',
                'label' => 'Identificador',
            ],
            [
                'attribute'=> 'name',
                'label' => 'Nome',
            ],
            [
                'attribute'=> 'price',
                'label' => 'Preço',
            ],
            [
                'attribute'=> 'description',
                'label' => 'Descrição',
            ],
            [
                'attribute'=> 'date',
                'label' => 'Data',
            ],
            [
                'label' => 'Designer(s)',
                'value' => function($model)
                {
                    $designer = [];
                    if($model->designers != null)
                    {
                        foreach($model->designers as $designer) {
        
                        $designers[] = $designer->name;
                        }
                        return implode(', ', $designers);
                    }
                    else
                    {
                        return 'Não há designers';
                    }
                },
            ],
            [
                'label' => 'Categoria(s)',
                'value' => function($model)
                {
                    $category = [];
                    if($model->categorys != null)
                    {
                        foreach($model->categorys as $category) {
        
                            $categorys[] = $category->name;
                        }
                        return implode(', ', $categorys);
                    }
                    else
                    {
                        return 'Não há categorias';
                    }

                },
            ],        
            [               
                'label' => 'Imagens',
                'value' => function($model){
                    $images = array();
                    foreach ($model->images as $image) {
                        array_push($images, Html::img(Yii::getAlias('@web').'/' . $image->name,  ['width'=>'100','height'=>'90']));
                    }
                    return implode(', ', $images);
                    
                },
                'format'=>'raw',       
            ],
        ],
    ]) ?>

</div>
