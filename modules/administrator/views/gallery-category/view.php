<?php

use app\helpers\DetailViewHelper;
use app\models\GalleryCategory;
use yii\web\View;
use yii\widgets\DetailView;

/* @var $this View */
/* @var $model GalleryCategory */
?>
<div class="gallery-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'slug',
            'description:ntext',
            [
                'attribute' => 'status',
                'value' => $model->getStatusWithStyle(),
                'format' => 'raw',
            ],
            'order',
            'created_at',
            'updated_at',
            DetailViewHelper::author($model, 'created_by'),
            DetailViewHelper::author($model, 'updated_by'),
        ],
    ]) ?>

</div>
