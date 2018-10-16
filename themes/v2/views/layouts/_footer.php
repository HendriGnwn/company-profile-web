<?php

use app\helpers\Url;
use app\models\BlogPostTag;
use app\models\Config;
use app\models\Menu as Menu2;
use yii\helpers\Html;
use yii\widgets\Menu;

?>

<!-- footer start -->
<div class="footer">
    <div class="footer_wrapper_second">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6 col-xs-12 col-sm-6">
                    <div class="wrapper_second_about">
                        <h4>About Us</h4>
                        <div class="abotus_content">
                            <p>Proin gravida nibh vel velit auctr aliquet. Aenean sollicitudin, lorem quis bibendum auctor, nisi elit aks consequat vel velit auctor....</p>
                        </div>
                        <div class="aboutus_link">
                            <a href="#">Read More<i class="fa fa-caret-right" aria-hidden="true"></i></a>
                        </div>
                        <?= Menu::widget([
                            'options' => ['class' => 'aboutus_social_icons'],
                            'items' => [
                                [
                                    'label' => '<i class=\'fa fa-facebook\'></i>',
                                    'url' => Config::getAppAccountFacebook(),
                                    'options' => ['target'=>'_blank'],
                                    'encode' => false,
                                ],
                                [
                                    'label' => '<i class=\'fa fa-twitter\'></i>',
                                    'url' => Config::getAppAccountTwitter(),
                                    'options' => ['target'=>'_blank'],
                                    'encode' => false,
                                ],
                                [
                                    'label' => '<i class=\'fa fa-google-plus\'></i>',
                                    'url' => Config::getAppAccountGooglePlus(),
                                    'options' => ['target'=>'_blank'],
                                    'encode' => false,
                                ],
                            ],
                        ]) ?>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-xs-12 col-sm-6">
                    <div class="wrapper_second_useful">
                        <h4>Useful Link</h4>
                        <?= Menu::widget([
//                            'options' => ['class' => 'footer-list'],
                            'items' => (new Menu2())->getMenus(Menu2::CATEGORY_MAIN_FOOTER),
                        ]) ?>
<!--                        <ul>
                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Ipsum. Proin gravida nibh vel</a>
                            </li>
                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Auctor aliquet. Aenean </a>
                            </li>
                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Din, lorem quis bibendum </a>
                            </li>
                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Nisi elit consequat ipsum,</a>
                            </li>
                            <li><a href="#"><i class="fa fa-caret-right" aria-hidden="true"></i> Sagittis sem nibh id elit. </a> </li>
                        </ul>-->
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-xs-12 col-sm-6">
                    <div class="wrapper_second_blog">
                        <h4>From the Blog</h4>
                        <div class="blog_wrapper1">
                            <div class="blog_image">
                                <img src="themes/v2/images/home/home-2/blog-img1.png" class="img-responsive" alt="blog-img1_img" />
                            </div>
                            <div class="blog_text">
                                <h5><a href="#">Last Booking Registration Date</a></h5>
                                <div class="blog_date"><i class="fa fa-calendar-o" aria-hidden="true"></i>June 28, 2018-19</div>
                            </div>
                        </div>
                        <div class="blog_wrapper2">
                            <div class="blog_image">
                                <img src="themes/v2/images/home/home-2/blog-img2.png" class="img-responsive" alt="blog-img2_img" />
                            </div>
                            <div class="blog_text">
                                <h5><a href="#">Learn Every Thing you Want</a></h5>
                                <div class="blog_date"><i class="fa fa-calendar-o" aria-hidden="true"></i>June 28, 2018-19</div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-md-6 col-xs-12 col-sm-6">
                    <div class="wrapper_second_contact">
                        <h4>Contact Us</h4>
                        <ul>
                            <li><i class="fa fa-map-marker"></i>
                                <p><?= Config::getAppContactAddress() ?></p>
                            </li>
                            <li><i class="fa fa-phone"></i>
                                <p><?= Config::getAppContactPhone() ?></p>
                            </li>
                            <li><i class="fa fa-envelope"></i><a href="mailto:<?= Config::getAppContactEmail() ?>"><?= Config::getAppContactEmail() ?></a>
                            </li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- footer end -->

<!-- copyright_wrapper start -->
<div class="copyright_wrapper">
    <div class="container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-xs-12 col-sm-12">
                <div class="copyright_content">
                    <p>Copyright &copy; 2018 <?= Html::a(Config::getAppCopyright(), Yii::$app->getHomeUrl()) ?> &nbsp;  | &nbsp;  All Rights Reserved</p>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- copyright_wrapper end -->