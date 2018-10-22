<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>

<?php if (Yii::$app->session->hasFlash('success')) { ?>
    <div class="alert fade_success">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <strong><?= Yii::t('app', 'Success Message') ?>: <?= Yii::$app->session->getFlash('success') ?></strong>
    </div>
<?php } ?>
<?php if (Yii::$app->session->hasFlash('error')) { ?>
    <div class="alert fade_error">
        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
        <strong><?= Yii::t('app', 'Error Message') ?>: <?= Yii::$app->session->getFlash('error') ?></strong>
    </div>
<?php } ?>