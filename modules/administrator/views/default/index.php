<?php
$this->title = Yii::t('app', 'Dashboard');
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="row">
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-aqua">
            <div class="inner">
                <h3><?= $members ?></h3>

                <p><?= Yii::t('app', 'Member') ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-bag"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-green">
            <div class="inner">
                <h3><?= $activedMembers ?></h3>

                <p><?= Yii::t('app', 'Active Member') ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-stats-bars"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-yellow">
            <div class="inner">
                <h3><?= $counterVisitor->value ?></h3>

                <p><?= $counterVisitor->label ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-person-add"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
    <div class="col-lg-3 col-xs-6">
        <!-- small box -->
        <div class="small-box bg-red">
            <div class="inner">
                <h3><?= app\helpers\FormatConverter::getDaysInDateRange('2018-09-26', date('Y-m-d')) ?>&nbsp;<sup style="font-size: 20px"><?= Yii::t('app', 'Day') ?></sup></h3>

                <p><?= $counterWebsiteAge->label ?></p>
            </div>
            <div class="icon">
                <i class="ion ion-pie-graph"></i>
            </div>
            <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
        </div>
    </div>
    <!-- ./col -->
</div>

<div class="row">
    <div class="col-md-12">
        <div class="box box-solid">
            <div class="box-header with-border">
                <h3 class="box-title"><?= Yii::t('app', 'Server Statistics') ?></h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <br/>
                <div class="col-md-6">
                    <p><?= $statisticsDisk->label ?>: <code><?= $statisticsDisk->notes ?></code></p>
                    <div class="progress">
                        <div class="progress-bar <?= $statisticsDiskProgressClass ?>" role="progressbar" aria-valuenow="<?= $statisticsDisk->value ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $statisticsDisk->value ?>%;">
                            <?= $statisticsDisk->value ?>%
                        </div>
                    </div>
                    <hr>
                    <p><?= $statisticsCpu->label ?>: <code><?= $statisticsCpu->notes ?></code></p>
                    <div class="progress">
                        <div class="progress-bar <?= $statisticsCpuProgressClass ?>" role="progressbar" aria-valuenow="<?= $statisticsCpu->value ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $statisticsCpu->value ?>%;">
                            <?= $statisticsCpu->value ?>%
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <p><?= $statisticsBandwidth->label ?>: <code><?= $statisticsBandwidth->notes ?></code></p>
                    <div class="progress">
                        <div class="progress-bar <?= $statisticsBandwidthProgressClass ?>" role="progressbar" aria-valuenow="<?= $statisticsBandwidth->value ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $statisticsBandwidth->value ?>%;">
                            <?= $statisticsBandwidth->value ?>%
                        </div>
                    </div>
                    <hr>
                    <p><?= $statisticsRam->label ?>: <code><?= $statisticsRam->notes ?></code></p>
                    <div class="progress">
                        <div class="progress-bar <?= $statisticsRamProgressClass ?>" role="progressbar" aria-valuenow="<?= $statisticsRam->value ?>" aria-valuemin="0" aria-valuemax="100" style="width: <?= $statisticsRam->value ?>%;">
                            <?= $statisticsRam->value ?>%
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.box-body -->
        </div>
    </div>
</div>
