<?php

use app\models\Service;
use kartik\select2\Select2;
use yii\helpers\Html;
use yii\web\View;
use yii\bootstrap\ActiveForm;

/* @var $this View */
/* @var $model Service */
/* @var $form ActiveForm */
?>

<div class="service-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'icon')->textInput(['maxlength' => true]) ?>
    <label class="">Referensi Icon <a href="https://fontawesome.com/icons" target="_blank">Font Awesome Icon</a></label>
    <br/><br/>

    <?= $form->field($model, 'description')->textarea(['row' => 6]) ?>

    <?= $form->field($model, 'metakey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metadesc')->textarea(['maxlength' => true]) ?>

    <?php
    $status = Service::statusLabels();
    $statusOptions = ['data' => $status, 'pluginOptions' => ['allowClear' => true], 'options' => ['prompt' => 'Choose One']];
    ?>
    <?= $form->field($model, 'status')->widget(Select2::className(), $statusOptions) ?>
    
    <?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
