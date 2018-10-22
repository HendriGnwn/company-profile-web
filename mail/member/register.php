<?php

use app\models\Config;
use app\models\Contact;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
/* @var $model Contact */

?>
<br/>
Hello <?= $model->getFullName() ?>,
<br/>
Selamat Anda telah bergabung bersama kami, Berikut adalah identitas Anda.
<br/>
<table id="test">
    <tr>
        <td><?= $model->getAttributeLabel('member_code') ?></td>
        <td>:</td>
        <td><?= $model->member_code ?></td>
    </tr>
    <tr>
        <td><?= $model->getAttributeLabel('first_name') ?></td>
        <td>:</td>
        <td><?= $model->first_name ?></td>
    </tr>
    <tr>
        <td><?= $model->getAttributeLabel('last_name') ?></td>
        <td>:</td>
        <td><?= $model->last_name ?></td>
    </tr>
    <tr>
        <td><?= $model->getAttributeLabel('email') ?></td>
        <td>:</td>
        <td><?= $model->email ?></td>
    </tr>
    <tr>
        <td><?= $model->getAttributeLabel('status') ?></td>
        <td>:</td>
        <td><?= $model->getStatusLabel() ?></td>
    </tr>
</table>
<br/>
Silahkan kunjungi Kantor Cabang kami di lokasi tempat tinggal terdekat Anda yaitu:<br/>
<table id="test">
    <tr>
        <td><?= $model->getAttributeLabel('branch_id') ?></td>
        <td>:</td>
        <td><?= $model->branch ? $model->branch->name : $model->branch_id ?></td>
    </tr>
    <tr>
        <td>Alamat</td>
        <td>:</td>
        <td><?= $model->branch ? $model->branch->address : '' ?></td>
    </tr>
    <tr>
        <td>Kecamatan</td>
        <td>:</td>
        <td><?= $model->branch ? $model->branch->district->name : '' ?></td>
    </tr>
    <tr>
        <td>Kota</td>
        <td>:</td>
        <td><?= $model->branch ? $model->branch->regency->name : '' ?></td>
    </tr>
    <tr>
        <td>Provinsi</td>
        <td>:</td>
        <td><?= $model->branch ? $model->branch->province->name : '' ?></td>
    </tr>
    <tr>
        <td>Kode Pos</td>
        <td>:</td>
        <td><?= $model->branch ? $model->branch->postal_code : '' ?></td>
    </tr>
</table>

<br/><br/>
Thanks

<br/><br/>
<?= Config::getAppCompanyName() ?>