<?php

use app\assets\AppAsset;
use app\models\Config;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\Breadcrumbs;

/* @var $this View */
/* @var $content string */

AppAsset::register($this);
Yii::$app->name = Yii::$app->name . ' | '. Config::getAppMotto();
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
    <title><?= Html::encode($this->title .' | '. Yii::$app->name) ?></title>
    <?php $this->head() ?>
</head>
<body id="top" class="has-header-search">
<?php $this->beginBody() ?>

    <?= $this->render('_header') ?>
    
    <!--page title start-->
    <div class="page_header">
        <div class="container">
            <div class="row">
                <div class="col-lg-8 col-md-8 col-xs-12 col-sm-6">
                    <h1><?= $this->title ?></h1>
                </div>
                <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                    <div class="sub_title_section">
                        <?= Breadcrumbs::widget([
                            'tag' => 'ul',
                            'options' => ['class' => 'sub_title'],
                            'itemTemplate' => '<li>{link} <i class="fa fa-angle-right" aria-hidden="true"></i></li>',
                            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        ]) ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--page title end-->
    
    <?= $this->render('_content', ['content' => $content]) ?>
    
    <?= $this->render('_footer') ?>
    
    <?= $this->render('_preloader') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
