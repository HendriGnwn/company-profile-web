<?php

/* @var $testimonials app\models\Testimonial */

?>

<div class="testimonial_section">
    <div class="testimonial_section_overlay"></div>
    <div class="container">
        <div class="row">
            <div class="testimonial_info">
                <div class="carousel slide" data-ride="carousel" id="testimonial_carousel">
                    <!-- Bottom Carousel Indicators -->
                    <ol class="carousel-indicators">
                        <?php foreach($testimonials as $key => $testimonial) : ?>
                        <li data-target="#testimonial_carousel" data-slide-to="<?= $key ?>" class="<?= $key == 0 ? 'active':'' ?>">
                            <img class="img-responsive " src="data/img/user.png" />
                        </li>
                        <?php endforeach; ?>
                    </ol>
                    <!-- Carousel Slides / Quotes -->
                    <div class="carousel-inner text-center">
                        <?php foreach($testimonials as $key => $testimonial) : ?>
                        <div class="item <?= $key == 0 ? 'active':'' ?>">
                            <div class="row">
                                <div class="col-sm-10 col-sm-offset-1">
                                    <h4><?= $testimonial->name ?>, <?= $testimonial->professional ?>.</h4>
                                    <p><?= $testimonial->description ?></p>
                                </div>
                            </div>
                        </div>
                        <?php endforeach; ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- testimonial_section end -->