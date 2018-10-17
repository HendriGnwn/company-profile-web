<?php

use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;
use yii\helpers\Html;

?>

<div class="comments_form_section <?= $sectionClass ?>">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 col-md-12 col-xs-12 col-sm-12 col-lg-offset-2">
                <div class="section_heading">
                    <h2><?= Yii::t('app', 'Leave a Message') ?></h2>
                    <span class="bordered-icon"><i class="fa fa-circle-thin"></i></span>
                </div>
                <div class="section_content">
                    <p><?= Yii::t('app', 'Contact us to provide a comment or ask a question about our features or our corporate') ?></p>
                </div>
            </div>
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <?php if (Yii::$app->session->hasFlash('contactFormSubmitted')) { ?>
                    <div class="alert fade_info .fade">
                        <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                        <strong><?= Yii::t('app', 'Success Message: Your message has been sent') ?></strong>
                    </div>
                <?php } ?>
                <?php
                $form = ActiveForm::begin([
                    'id' => 'main-contact-form',
                    'options' => [
                        'class' => 'clearfix',
                    ],
                    'fieldConfig' => [
                        'template' => "\n{label}\n{input}\n{error}",
                        'labelOptions' => ['class' => 'sr-only'],
                        'inputOptions' => ['class' => 'form-control', 'style' => 'background:#fff !important'],
                        'errorOptions' => ['style' => 'margin-top: 0px; position:absolute !important;color:#fff !important;font-weight:normal !important;', 'class' => 'help-block help-block-error label label-danger'],
                    ]
                ]);
                ?>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-pos">
                            <?= $form->field($model, 'first_name')
                                ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('first_name')]) ?>
                        </div>
                    </div>
                    <!-- /.col-md-4 -->
                    <div class="col-md-6">
                        <div class="form-e">
                            <?= $form->field($model, 'last_name')
                                ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('last_name')]) ?>
                        </div>
                    </div>
                    <!-- /.col-md-4 -->
                    <div class="col-md-6">
                        <div class="form-s">
                            <?= $form->field($model, 'email')
                            ->textInput(['maxlength' => true, 'type' => 'email', 'placeholder'=> $model->getAttributeLabel('email')]) ?>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-s">
                            <?= $form->field($model, 'phone')
                            ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('phone')]) ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-s">
                            <?= $form->field($model, 'subject')
                            ->textInput(['maxlength' => true, 'placeholder'=> $model->getAttributeLabel('subject')]) ?>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-s">
                            <?= $form->field($model, 'description')
                            ->textarea(['maxlength' => true, 'class'=>'form-control', 'placeholder'=> $model->getAttributeLabel('description'), 'rows' => 5]) ?>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="form-s">
                            <?= $form->field($model, 'verifyCode', [
                                'errorOptions' => [
                                    'style' => 'margin-top:10px;color:#fff',
                                ],
                                'labelOptions' => [
                                    'style' => 'margin-top:-20px;',
                                ],
                            ])->widget(Captcha::className(), [
                                'template' => '<div class="row"><div class="col-lg-3" style="margin-right:10px;">{image}</div><div class="col-lg-6">{input}</div></div>',
                                'options' => ['class'=>'form-control', 'placeholder' => 'Captcha', 'style' => 'background:#fff !important']
                            ]) ?>
                        </div>
                    </div>
                </div>
                <!-- /.row-->
                <?= Html::submitButton(Yii::t('app.button', 'Send Message'), ['class' => 'btn btn-primary btn-block']) ?>
                <?php ActiveForm::end(); ?>
            </div>
        </div>
    </div>
</div>