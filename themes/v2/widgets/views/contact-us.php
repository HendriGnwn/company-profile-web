<?php

use app\models\Config;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

?>

<section id="contact" class="section-padding contact-form-wrapper">

    <div class="container">

        <div class="text-center mb-80">
            <h2 class="section-title text-uppercase">Get in Touch</h2>
            <p class="section-sub">Contact us to provide a comment or ask a question about our features or our corporate</p>
        </div>

        <div class="row">
            
            <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) { ?>
                <div class="alert success-icon icon" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                    <i class="fa fa-lg fa-thumbs-o-up"></i> Success Message: Your message has been sent
                </div>
            <?php } ?>

            <div class="col-md-8">
                <?php
                $form = ActiveForm::begin([
                    'id' => 'main-contact-form',
                    'options' => [
                        'class' => 'clearfix',
                    ],
                    'fieldConfig' => [
                        'template' => "<div class=\"input-field\">\n{input}\n{label}\n{error}</div>",
                        'labelOptions' => ['class' => null],
                        'inputOptions' => ['class' => 'validate'],
                        'errorOptions' => ['style' => 'margin-top: -10px; position:absolute !important;color:#fff !important;font-weight:normal !important;', 'class' => 'help-block help-block-error label label-danger'],
                    ]
                ]);
                ?>
                
                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'first_name')->textInput(['maxlength' => true]) ?>
                        </div><!-- /.col-md-6 -->
                        
                        <div class="col-md-6">
                            <?= $form->field($model, 'last_name')->textInput(['maxlength' => true]) ?>
                        </div><!-- /.col-md-6 -->
                        
                    </div><!-- /.row -->

                    <div class="row">
                        <div class="col-md-6">
                            <?= $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']) ?>
                        </div><!-- /.col-md-6 -->
                        
                        <div class="col-md-6">
                            <?= $form->field($model, 'phone')->textInput(['maxlength' => true]) ?>
                        </div><!-- /.col-md-6 -->

                    </div><!-- /.row -->
                    
                    <div class="row">
                        <div class="col-md-12">
                            <?= $form->field($model, 'subject')->textInput(['maxlength' => true]) ?>
                        </div><!-- /.col-md-6 -->
                    </div><!-- /.row -->

                    <?= $form->field($model, 'description')->textarea(['maxlength' => true, 'class'=>'materialize-textarea']) ?>
                    
                    <?= $form->field($model, 'verifyCode', [
                        'errorOptions' => [
                            'style' => 'margin-top:10px;color:#fff',
                        ],
                        'labelOptions' => [
                            'style' => 'margin-top:-20px;',
                        ]
                    ])->widget(Captcha::className(), [
                        'template' => '<div class="row"><div class="col-lg-3">{image}</div><div class="col-lg-6">{input}</div></div>',
                        'options' => ['class'=>'']
                    ]) ?>
                    
                    <?= Html::submitButton(Yii::t('app.button', 'Send Message'), ['class' => 'waves-effect waves-light btn pink right mt-30']) ?>
                    
                <?php ActiveForm::end(); ?>
            </div><!-- /.col-md-8 -->

            <div class="col-md-4 contact-info">

                <address>
                    <i class="material-icons brand-color">&#xE8B4;</i>
                    <div class="address">
                        <p><?= Config::getAppContactAddress() ?></p>
                    </div>

                    <i class="material-icons brand-color">&#xE61C;</i>
                    <div class="phone">
                        <p>Phone: <?= Config::getAppContactPhone() ?></p>
                    </div>

                    <i class="material-icons brand-color">&#xE0B7;</i>
                    <div class="mail">
                        <p><?= Html::a(Config::getAppContactEmail(), 'mailto:'.Config::getAppContactEmail()) ?><br>
                            <?= Html::a(Yii::$app->params['mainUrl'], Yii::$app->getHomeUrl()) ?></p>
                    </div>
                </address>
            </div><!-- /.col-md-4 -->
        </div><!-- /.row -->
    </div>
</section>