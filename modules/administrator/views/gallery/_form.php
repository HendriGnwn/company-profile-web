<?php

use app\models\Gallery;
use app\models\GalleryCategory;
use kartik\select2\Select2;
use yii\helpers\ArrayHelper;
use yii\helpers\Html;
use yii\web\View;
use yii\widgets\ActiveForm;

/* @var $this View */
/* @var $model Gallery */
/* @var $form ActiveForm */
?>

<div class="gallery-form">

    <?php $form = ActiveForm::begin([
		'options' => [
            'enctype' => 'multipart/form-data',
        ]
	]); ?>

    <?php
    $portfolios = ArrayHelper::map(GalleryCategory::find()->actived()->all(), 'id', 'name');
    $portfolioOptions = ['data' => $portfolios, 'pluginOptions' => ['allowClear' => true, 'multiple' => true], 'options' => ['prompt' => 'Choose One', 'value' => $model->gallery_category]];
    ?>
    <?= $form->field($model, 'gallery_category[]')->widget(Select2::className(), $portfolioOptions) ?>

    <?= $form->field($model, 'name')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'photoFile')->fileInput(['maxlength' => true]) ?>
    
    <?= $form->field($model, 'is_video')->checkbox() ?>
    
    <?= $form->field($model, 'video_url')->textInput() ?>

    <?= $form->field($model, 'description')->textarea(['maxlength' => true]) ?>

    <?= $form->field($model, 'metakey')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'metadesc')->textarea(['maxlength' => true]) ?>

    <?php
    $status = Gallery::statusLabels();
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
<?php
$this->registerJs("
   
    $('#Gallery_is_video').click(function() {
        isVideo();
    });
    
    function isVideo() {
        if ($('#Gallery_is_video').is(':checked') == true) {
            $('#Gallery_video_url').attr('readonly', true);
        } else {
            $('#Gallery_video_url').removeAttr('readonly');
        }
    }

");
