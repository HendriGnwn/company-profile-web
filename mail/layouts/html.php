<?php

use app\helpers\Url;
use app\models\Config;
use yii\helpers\Html;

/* @var $this \yii\web\View view component instance */
/* @var $message \yii\mail\MessageInterface the message being composed */
/* @var $content string main view render result */
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <style>
        .main_cta img { width: 100%; height: auto !important; }

        /* Footer Anchor Navigation Pattern CSS */
        @media only screen and (max-width: 500px) {
            td[id="header"] {
                padding-bottom: 10px;
            }
            td[class="toggle"] {
                display: table-cell !important;
                width: auto !important;
                height: auto !important;
                max-width: inherit !important;
                max-height: inherit !important;
                float: none !important;
                overflow: auto !important;
                font-size: 12px !important;
                font-family: arial,sans-serif;
            }
            td[class="toggle"] a {
                display: block;
                padding: 10px 0;
            }
            tr[class="main_nav"] {
                display: table-footer-group;
            }
            tr[class="main_nav"] td {
                display: block;
                width: 100%;
                padding: 0 !important;
            }
            tr[class="main_nav"] a {
                display: block;
                width: 100%;
                padding: 20px 0;
                border-bottom: 1px solid #999;
            }
            tr[class=main_cta] {
                display: table-header-group;
            }
        }
    </style>
    
    <table class="container" width="100%" cellpadding="0" cellspacing="0" style="margin:0 auto;">
        <tr align="center">
            <td align="center">
                <table cellpadding="0" cellspacing="0">
                    <tr>
                        <td id="header">
                            <table cellpadding="0" cellspacing="0" width="100%">
                                <tr>
                                    <td align="right" class="toggle" style="display: none; width: 0; max-height: 0; max-width: 0; height: 0; overflow: hidden; float: left; font-size: 0;">
                                        <a href="#mobile_nav">Menu</a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                    <tr class="main_nav">
                        <td id="mobile_nav" width="600">
                            <table cellpadding="0" cellspacing="0" width="100%" style="background-color: #FAFAF0;">
                                <tr>
                                    <td align="center" style="padding: 15px 20px; font-family: arial,sans-serif; font-size: 14px; font-weight: bold;">
                                        <a href="<?= Url::to(['/'], true) ?>" style="text-decoration: none; color: #03A9F4;"><?= Yii::t('app', 'Home') ?></a>
                                    </td>
                                    <td align="center" style="padding: 15px 20px; font-family: arial,sans-serif; font-size: 14px; font-weight: bold;">
                                        <a href="<?= Url::to(['/site/about'], true) ?>" style="text-decoration: none; color: #03A9F4;"><?= Yii::t('app', 'Program') ?></a>
                                    </td>
                                    <td align="center" style="padding: 15px 20px; font-family: arial,sans-serif; font-size: 14px; font-weight: bold;">
                                        <a href="<?= Url::to(['/site/contact'], true) ?>" style="text-decoration: none; color: #03A9F4;"><?= Yii::t('app', 'Contact Us') ?></a>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
                
                <table cellpadding="0" cellspacing="0">
                    <tr class="main_nav">
                        <td width="600">
                            <?= $content ?>
                            <br/>
                        </td>
                    </tr>
                </table>
                
                <table cellpadding="0" cellspacing="0">
                    <tr class="main_nav">
                        <td width="600">
                            <hr/>
                            <p>
                                This email was sent by: <?= Yii::$app->name ?><br>
                                <?= Config::getAppContactAddress() ?><br><br>
                            </p>
                        </td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
