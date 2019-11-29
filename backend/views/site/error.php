<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

if($name == 'Forbidden (#403)')
{
    $this->title = "Erro de permissão!";
}
?>
<section class="content">

    <div class="error-page">
        <h2 class="headline text-info"><i class="fa fa-warning text-yellow"></i></h2>

        <div class="error-content">
            <?php if($name == 'Forbidden (#403)')
            {
                ?>
                <h3>Erro de permissão!</h3>
                <?php
            }
            ?>

            <p>
                <?= nl2br(Html::encode($message)) ?>
            </p>

            <p>
                Você não tem permissão para executar esta ação. 
                Deve voltar para o  <a href='<?= Yii::$app->homeUrl ?>'>painel de controlo.</a>
            </p>
        </div>
    </div>

</section>
