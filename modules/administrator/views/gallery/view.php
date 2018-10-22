<?php

use app\helpers\DetailViewHelper;
use app\models\Gallery;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model Gallery */
?>
<div class="gallery-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'portfolio_id',
                'value' => $model->portfolio ? $model->portfolio->name : $model->portfolio_id,
            ],
            'name',
            [
                'attribute' => 'photo',
                'value' => $model->getPhotoUrlHtml(),
                'format' => 'raw',
            ],
            'video_url',
            'description:ntext',
			'metakey',
            'metadesc',
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
            'created_at',
            'updated_at',
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>

</div>
