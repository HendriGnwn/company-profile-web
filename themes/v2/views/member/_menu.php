<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
?>

<?= $this->render('_alert') ?>

<?= \yii\widgets\Menu::widget([
    'options' => [
        'class' => 'nav nav-tabs nav-justified'
    ],
    'itemOptions' => [
        //'data-toggle' => 'tab'
    ],
    'items' => [
        ['label' => Yii::t('app', 'Profile'), 'url' => ['/member/profile']],
        ['label' => Yii::t('app', 'Photo Details'), 'url' => ['/member/photo']],
        ['label' => Yii::t('app', 'Branch Office Information'), 'url' => ['/member/branch-information']],
        ['label' => Yii::t('app', 'Update Profile'), 'url' => ['/member/update-profile']],
        ['label' => Yii::t('app', 'Change Password'), 'url' => ['/member/change-password']],
    ]
]) ?>