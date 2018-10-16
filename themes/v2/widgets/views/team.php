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
<section class="section-padding gray-bg">

    <div class="container">
        <div class="text-center mb-80">
            <h2 class="section-title text-uppercase">Awesome Team</h2>
            <p class="section-sub">Quisque non erat mi. Etiam congue et augue sed tempus. Aenean sed ipsum luctus, scelerisque ipsum nec, iaculis justo. Sed at vestibulum purus, sit amet viverra diam nulla ac nisi rhoncus.</p>
        </div>

        <div class="row">
            <div class="col-md-offset-1 col-md-10 col-xs-12">
                <?php foreach ($teams as $team) : ?>
                    <div class="col-md-6 col-sm-6">
                        <div class="team-wrapper">
                            <div class="team-img">
                                <?php
                                $img = $team->photo ? $team->getPhotoUrl() : ['data/img/working-man.png'];
                                ?>
                                <?= Html::img($img, ['alt' => $team->first_name, 'class' => 'img-responsive']) ?>
                            </div><!-- /.team-img -->

                            <div class="team-title">
                                <h3><?= Html::a($team->getFullName(), '#') ?></h3>
                                <span><?= $team->professional ?></span>
                                <?= $team->description ?>
                            </div><!-- /.team-title -->

                            <ul class="team-social-links list-inline text-center">
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

                        </div><!-- /.team-wrapper -->
                    </div><!-- /.col-md-4 -->
                <?php endforeach; ?>
            </div>

        </div><!-- /.row -->
    </div><!-- /.clients-grid -->

</div><!-- /.container -->
</section>