<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model app\models\GalleryCategory */
?>
<div class="gallery-category-view">
 
    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'name',
            'slug',
            'description:ntext',
            'status',
            'order',
            'created_at',
            'updated_at',
            'created_by',
            'updated_by',
        ],
    ]) ?>

</div>
