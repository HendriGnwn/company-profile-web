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
Kamu telah melakukan submit lupa password dengan detail dan password baru sebagai berikut:
<br/>
<table id="test">
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
        <td>Password Baru</td>
        <td>:</td>
        <td><?= $newPassword ?></td>
    </tr>
</table>

<br/><br/>
Thanks

<br/><br/>
<?= Config::getAppCompanyName() ?>