<?php

use app\models\Team;
use yii\helpers\Html;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/* @var $team Team */

?>
<div class="section_3">
    <div class="section3_img_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-12 col-xs-12 col-sm-12 col-lg-offset-3">
                <div class="section_heading text_wrapper">
                    <h2 style="color:#fff"><?= Yii::t('app', 'Our Team') ?></h2>
                    <span class="bordered-icon"><i class="fa fa-square"></i></span>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <?php foreach ($teams as $team) : ?>
                <div class="col-lg-3 col-md-3 col-xs-12 col-sm-6">
                    <div class="section3_content_wrapper">
                        <div class="section3_image_wrapper">
                            <?= Html::img($team->getPhotoUrl(), ['alt' => $team->first_name, 'class' => 'img-responsive', 'width' => '200']) ?>
                            <div class="section3_imgage_overlay">
                                <div class="content_wrapper">
                                    <ul class="section3_social_icons">
                                        <?php
                                        $facebook = $team->social_facebook ? $team->social_facebook : '#';
                                        $twitter = $team->social_twitter ? $team->social_twitter : '#';
                                        $linkedIn = $team->social_linked_in ? $team->social_linked_in : '#';
                                        $dribbble = $team->social_dribbble ? $team->social_dribbble : '#';
                                        $email = $team->social_email ? 'mailto:'.$team->social_email : '#';
                                        ?>
                                        <li><?= Html::a('<i class=\'fa fa-facebook\'></i>', $facebook, ['target' => '_blank']) ?></li>
                                        <li><?= Html::a('<i class=\'fa fa-twitter\'></i>', $twitter, ['target' => '_blank']) ?></li>
                                        <li><?= Html::a('<i class=\'fa fa-linkedin\'></i>', $linkedIn, ['target' => '_blank']) ?></li>
                                        <li><?= Html::a('<i class=\'fa fa-dribbble\'></i>', $dribbble, ['target' => '_blank']) ?></li>
                                        <li><?= Html::a('<i class=\'fa fa-envelope-o\'></i>', $email, ['target' => '_blank']) ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="section3_text_wrapper">
                            <h4><?= Html::a($team->getFullName(), '#') ?></h4>
                            <h5><?= $team->professional ?></h5>
                        </div>
                    </div>
                </div>
                <?php endforeach; ?>
            </div>
        </div>
        <!-- row end -->
    </div>
    <!-- container end -->
</div>