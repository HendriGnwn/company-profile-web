<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
?>

<section class="error-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-sm-5">
                <i class="fa fa-warning"></i>
            </div>

            <div class="col-sm-7">
                <div class="error-info">
                    <h1 class="mb-30"><?= Html::encode($code) ?></h1>
                    <span class="error-sub"><?= nl2br(Html::encode($message)) ?></span>

                    <p>Sorry, but we can’t seem to find the page you are looking for.</p>
                    <?= Html::a(Yii::t('app.button', 'Take Me Home'), Yii::$app->getHomeUrl(), ['class'=>'btn btn-lg waves-effect waves-light']) ?>
                </div>
            </div>
        </div>
    </div>
</section>