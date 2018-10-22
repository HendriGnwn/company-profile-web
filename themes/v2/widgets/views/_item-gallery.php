<?php

use app\models\Portfolio;
use yii\helpers\Html;
use yii\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $model Portfolio */
$photoUrl = $model->getPhotoUrl();
$photoName = $model->name;
$photoImg = $model->getPhotoImg([
    'alt' => $photoName, 
    'class' => 'img-responsive'
]);
?>
<div class="portfolio_img_wrapper">
    <?php if ($model->is_video == 0) : ?>
    <div class="portfolio_img">
        <?= $photoImg ?>
        <div class="portfolio_img_overlay">
            <div class="portfolio_img_text">
                <?= Html::a("<i class='fa fa-plus' aria-hidden='true'></i>", $photoUrl, ['class' => 'search', 'alt' => $photoName]) ?>
                <?= Html::a("<i class='fa fa-chain' aria-hidden='true'></i>", ['/']) ?>
            </div>
        </div>
    </div>
    <?php else: ?>
    <div class="portfolio_img youtube_player">
        <iframe width="100%" height="360" src="<?= $model->video_url ?>" frameborder="0" allow="encrypted-media" allowfullscreen></iframe>
    </div>
    <?php endif; ?>
</div>
<!--    <div class="vimeo_player">
        <iframe src="http://techslides.com/demos/sample-videos/small.mp4" height="342" style="width:100%;" allowfullscreen=""></iframe>
    </div>-->