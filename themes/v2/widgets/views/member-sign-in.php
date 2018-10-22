<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<?php if (\Yii::$app->member->isGuest) : ?>
<li class="dropdown signin_wrapper">
    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
        <i class="fa fa-sign-in"></i> Login / Register
    </a>
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
    <ul class="dropdown-menu">
        <li class="signin_dropdown">
            <div class="sign_up_message">
                <div class="section_heading">
                    <h3><?= Yii::t('app', 'Login for Membership') ?></h3><br/>
                    <span class="bordered-icon"><i class="fa fa-square"></i></span>
                </div>
            </div>
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
<!--                    <a href="" class="forget_password">
                        Forgot Password
                    </a>-->
                </div>
            </div>
            <div class="login_wrapper">
                <?= Html::submitButton('Sign in', ['class' => 'btn btn-primary login_btn', 'name' => 'login-button']) ?>
            </div>
            <div class="sign_up_message">
                <p>
                    <?= Yii::t('app', 'Don’t have an account ?') ?>
                    <?= Html::a(Yii::t('app', 'Sign Up'), ['/member/signup']) ?>
                </p>
            </div>
            <?php ActiveForm::end(); ?>
        </li>
    </ul>
</li>
<?php else: ?>
<li class="signin_wrapper">
    <?= Html::a(
        '<i class="fa fa-user"></i>  Hi ' . Yii::$app->member->identity->first_name,
        ['member/profile']
    ) ?>
</li>
<li class="signin_wrapper">
    <?= Html::a(
        '<i class="fa fa-sign-out"></i> ' . Yii::t('app', 'Sign out'),
        ['member/signout'],
        ['data-method' => 'post']
    ) ?>
</li>

<?php endif; ?>
