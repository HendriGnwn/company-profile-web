<?php

/* @var $this yii\web\View */
/* @var $name string */
/* @var $message string */
/* @var $exception Exception */

use yii\helpers\Html;

$this->title = 'Under Maintenances';
?>

<section class="error-wrapper">
    <div class="container">
        <div class="row">
            <div class="col-md-offset-2 col-sm-3">
                <i class="material-icons colored brand-icon">web</i>
            </div>

            <div class="col-sm-7">
                <div class="error-info">
                    <h1 class="mb-30"><?= Html::encode('OPPS!') ?></h1>
                    <span class="error-sub"><?= nl2br(Html::encode('Sorry, This website is under maintenances.')) ?></span>
                </div>
            </div>
        </div>
    </div>
</section>