<?php

use app\models\Menu as Menu2;
use dmstr\widgets\Menu;
use yii\helpers\ArrayHelper;

?>

<aside class="main-sidebar">

    <section class="sidebar">

        <?php
        $items = (new Menu2())->getMenus(Menu2::CATEGORY_BACKEND);
        $staticItems = [
            ['label' => Yii::t('app.menu', 'Main Menu'), 'options' => ['class' => 'header']]
        ];
        $items = ArrayHelper::merge($staticItems, $items);
        ?>
        <?= Menu::widget(
            [
                'options' => ['class' => 'sidebar-menu tree', 'data-widget' => 'tree'],
                'items' => $items
            ]
        ) ?>

    </section>

</aside>
