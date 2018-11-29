<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* @var $model app\models\Contact */

?>
<br/>
Dear Admin,
<br/>
Seseorang menghubungi via Form Kontak Kami dengan detail sebagai berikut:
<br/>
<table>
    <tr>
        <td>Nama</td>
        <td>:</td>
        <td><?= $model->getFullName() ?></td>
    </tr>
    <tr>
        <td>Email</td>
        <td>:</td>
        <td><?= $model->email ?></td>
    </tr>
    <tr>
        <td>No HP</td>
        <td>:</td>
        <td><?= $model->phone ?></td>
    </tr>
    <tr>
        <td><?= Yii::t('app', 'Subject') ?></td>
        <td>:</td>
        <td><?= $model->subject ?></td>
    </tr>
</table>
<?= Yii::t('app', 'Description') ?>: <br/>
<?= $model->description ?>

<br/><br/>
Terimakasih