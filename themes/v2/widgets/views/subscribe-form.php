<?php

use yii\bootstrap\ActiveForm;
use yii\helpers\Html;


?>

<!--full width promo default box start-->
<div id="subscribe-form" class="full-width promo-box promo-parallax mb-50">
    <div class="container">
        
        <?php if (Yii::$app->session->hasFlash('SubscribeFormSubmitted')) { ?>
            <div class="alert success-icon icon" role="alert">
                <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <i class="fa fa-lg fa-thumbs-o-up"></i> Success Message: Your email has been saved, you will give our newsletter
            </div>
        <?php } ?>
        
        <?php $form = ActiveForm::begin(['options' => ['class' => 'subscribe-form mailchimp']]) ?>

            <div class="col-xs-12 col-md-7">
                <h2 class="text-uppercase text-bold">Subscribe <span class="brand-color">Now</span></h2>
                <p>Please fill in your email to get our newsletter and new events</p>

            </div>

            <div class="col-xs-12 col-md-5">
                <div class="input-group">
                    <?= $form->field($model, 'email', ['template'=>'{input}{error}', 'errorOptions' => ['style'=>'position:absolute;top:45px;']])->textInput(['maxlength' => true, 'class' => 'form-control subscribe-input', 'placeholder' => 'Type your email']) ?>
                    <span class="input-group-btn">
                        <?= Html::submitButton(Yii::t('app.button', 'Subscribe Now'), ['class' => 'btn waves-effect waves-light subscribe-button btn-block']) ?>
                    </span>
                </div>
                <style>
                    .subscribe-input {
                        float:left;
                        padding: 8px 15px !important;
                        border: 2px solid #03A9F4 !important;
                        color: #03A9F4;
                    }
                </style>
            </div>

        <?php ActiveForm::end() ?>

    </div>
</div>
<!--full width promo default box end-->