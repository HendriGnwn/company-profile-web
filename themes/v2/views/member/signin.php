<?php

use app\components\View;
use app\models\BlogPost;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $postDetail BlogPost */

$this->title = Yii::t('app', 'Member Signin');
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
                        'action' => ['/member/signin'],
                        'id' => 'member-signin-form',
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
                        <div class="formsix-pos">
                            <?= $form->field($model, 'email')
                                ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('email')]) ?>
                        </div>
                        <div class="formsix-e">
                            <?= $form->field($model, 'password')
                                ->passwordInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('password')]) ?>
                        </div>
                        <div class="row remember_box">
                            <div class="col-md-5" style="padding-right: 0px;">
                                <?= $form->field($model, 'rememberMe')->checkbox() ?>
                            </div>
                            <div class="col-md-7">
                                <?= Html::a('Forgot Password', ['/member/forgot-password'], ['class' => 'forget_password']) ?>
                            </div>
                        </div>
                        <div class="login_btn_wrapper">
                            <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary login_btn', 'name' => 'login-button']) ?>
                        </div>
                        <div class="sign_up_message">
                            <p>
                                <?= Yii::t('app', 'Don’t have an account ?') ?>
                                <?= Html::a(Yii::t('app', 'Sign In'), ['/member/signin']) ?>
                            </p>
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