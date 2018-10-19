<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = $name;
$this->registerCssFile('themes/v2/css/404_style_2.css');
?>
<div class="main_wrapper_two">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 col-lg-offset-2">
                <div class="main_wrapper_two_content">
                    <h2>Error <?= Html::encode($code) ?></h2>
                    <h1><?= nl2br(Html::encode($message)) ?></h1>
                    <p>Sorry, but we can’t seem to find the page you are looking for.</p>
                    <?= Html::a(Yii::t('app.button', 'Take Me Home'), Yii::$app->getHomeUrl()) ?>
                </div>
            </div>
        </div>
    </div>
</div>