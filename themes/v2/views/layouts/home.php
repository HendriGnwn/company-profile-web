<?php

use app\assets\HomeAsset;
use yii\helpers\Html;
use yii\web\View;

/* @var $this View */
/* @var $content string */

HomeAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="<?= app\helpers\Url::to('favicon.ico') ?>" type="image/x-icon">
    <link rel="icon" href="<?= app\helpers\Url::to('favicon.ico') ?>" type="image/x-icon">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode(Yii::$app->name . ' | ' . $this->title) ?></title>
    <?php $this->head() ?>
</head>
<body id="top">
<?php $this->beginBody() ?>
    
    <a href="javascript:" id="return-to-top"><i class="fa fa-angle-up"></i></a>

    <?= $this->render('_header') ?>
    
    <?= $this->render('_content', ['content' => $content]) ?>
    
    <?= $this->render('_footer') ?>
    
    <?= $this->render('_preloader') ?>
    
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
