<div class="services_section bg-white">
    <div class="container">
        <div class="section_heading">
            <h2><?= Yii::t('app', 'What We Do') ?></h2>
            <p>Proin gravida nibh vel velit auctor aliquet.</p>
        </div>
        <div class="row">
            <?php foreach ($services as $service) : ?>
            <div class="col-lg-4 col-md-4 col-xs-12 col-sm-6">
                <div class="icon_text">
                    <div class="icon_text_effect">
                        <i class="fa fa-eye" aria-hidden="true"></i>
                    </div>
                    <h4 class="text-center"><a href="#"><?= $service->name ?></a></h4>
                    <p class="text-center"><?= $service->description ?></p>
                </div>
            </div>
            <?php endforeach; ?>
        </div>
    </div>
</div>
<!-- services_section end -->