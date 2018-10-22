<?php

use app\components\View;
use app\models\BlogPost;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $postDetail BlogPost */

$this->title = Yii::t('app', 'Forgot Password');
$this->params['breadcrumbs'][] = ['label' => 'Member', 'url' =>['#']];
$this->params['breadcrumbs'][] = $this->title;

$metakey  = $metadesc = '';

/** SEO */
$this->registerMetaTag([
    'http-equiv' => 'Content-Type',
    'content' => 'text/html; charset=utf-8'
]);
$this->registerLinkAlternate();
$this->registerLinkCanonical();
$this->registerMetaTitle();
$this->registerMetaKeywords($metakey);
$this->registerMetaDescription($metadesc);
$this->registerMetaTag(['name' => 'robots',  'content' => 'index,follow']);
$this->registerMetaTag(['name' => 'googlebot',  'content' => 'index,follow']);
$socialMedia = [
    'title' => $this->title,
    'description' => $metadesc
];
$this->registerMetaSocialMedia($socialMedia);
$this->registerCssFile('/themes/v2/css/login_and_register.css');
?>

<div class="login_section">
    <div class="login_section_overlay"></div>
    <!-- login_form_wrapper -->
    <div class="login_form_wrapper">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-md-offset-2">
                    <?php
                    $form = ActiveForm::begin([
                        'action' => ['/member/forgot-password'],
                        'id' => 'member-forgot-password-form',
                        'options' => [
                            'class' => 'clearfix',
                        ],
                        'fieldConfig' => [
                            'template' => "\n{label}\n{input}\n{error}",
                            'labelOptions' => ['class' => 'sr-only'],
                            'inputOptions' => ['class' => 'form-control'],
                            'errorOptions' => ['style' => 'margin-top: 0px; position:absolute !important;color:#fff !important;font-weight:normal !important;', 'class' => 'help-block help-block-error label label-danger'],
                        ]
                    ]);
                    ?>
                    <!-- login_wrapper -->
                    <div class="login_wrapper">
                        
                        <?= $this->render('_alert') ?>
                        
                        <?= $form->errorSummary($model, ['class' => 'alert alert_error', 'style'=>'text-transform: inherit']) ?>
                        
                        <div class="formsix-pos">
                            <?= $form->field($model, 'email')
                                ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('email')]) ?>
                        </div>
                        <div class="login_btn_wrapper">
                            <?= Html::submitButton(Yii::t('app', 'Forgot'), ['class' => 'btn btn-primary login_btn', 'name' => 'login-button']) ?>
                        </div>
                        <?php ActiveForm::end(); ?>
                    </div>
                    <!-- /.login_wrapper-->
                </div>
            </div>
        </div>
    </div>
    <!-- /.login_form_wrapper-->
</div>