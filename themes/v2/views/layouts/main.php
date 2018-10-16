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
    <section class="page-title page-title-center cover-3 padding-top-220 padding-bottom-120 overlay purple-5 fixed-bg">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <h2 class="white-text font-40 text-bold"><?= $this->title ?></h2>
                    <?= Breadcrumbs::widget([
                        'tag' => 'ol',
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                    ]) ?>
                </div>
            </div>
        </div>
    </section>
    <!--page title end-->
    
    <?= $this->render('_content', ['content' => $content]) ?>
    
    <?= $this->render('_footer') ?>
    
    <?= $this->render('_preloader') ?>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
