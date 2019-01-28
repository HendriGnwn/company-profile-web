<?php

use yii\helpers\Html;
use yii\helpers\Url;

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

?>
<!-- slider section Start -->
<div class="slider_main_wrapper">
    <div id="rev_slider_1052_1_wrapper" class="rev_slider_wrapper fullscreen-container" data-alias="web-product-dark122" data-source="gallery" style="background-color:transparent;padding:0px;">
        <!-- START REVOLUTION SLIDER 5.4.1 fullscreen mode -->
        <div id="rev_slider_1052_1" class="rev_slider fullscreenbanner" style="display:none;" data-version="5.4.1">
            <ul>
                <!-- SLIDE  -->
                <?php if (count($models) < 0) { ?>
                    <li data-index="rs-2946" data-transition="slidevertical" data-slotamount="1" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="1500" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Intro" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                        <!-- MAIN IMAGE -->
                        <img src="https://via.placeholder.com/1250x550/555555" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>

                        <div class="tp-caption WebProduct-Title-Light   tp-resizeme" id="slide-2946-layer-7" data-x="['left','left','left','left']" data-hoffset="['120','30','200','80']" data-y="['middle','middle','top','top']" data-voffset="['-210','-80','137','130']" data-fontsize="['70','70','50','50']" data-lineheight="['90','90','50','50']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11; white-space: nowrap;">Creative
                            <br/> Websites
                        </div>

                        <div class="tp-caption WebProduct-Content-Light   tp-resizeme" id="slide-2946-layer-9" data-x="['left','left','left','left']" data-hoffset="['120','30','200','80']" data-y="['middle','middle','top','top']" data-voffset="['-30','127','300','270']" data-fontsize="['18','16','16','13']" data-lineheight="['27','27','22','22']" data-width="['448','356','334','277']" data-height="['none','none','76','68']" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13; min-width: 448px; max-width: 448px; white-space: normal;">
                            We have a number of different teams within our agency that specialise in different areas of business so you that receive a generic service.
                        </div>

                        <div class="tp-caption WebProduct-Button rev-btn " id="slide-2946-layer-8" data-x="['left','left','left','left']" data-hoffset="['120','30','200','80']" data-y="['middle','middle','top','top']" data-voffset="['90','268','450','400']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"jumptoslide","slide":"rs-2948","delay":""}]' data-responsive_offset="on" data-responsive="off" data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1750,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"},{"frame":"hover","speed":"300","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(51, 51, 51, 1.00);bg:rgba(255, 255, 255, 1.00);bw:2px 2px 2px 2px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[40,40,40,40]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[40,40,40,40]" style="z-index: 14; white-space: nowrap; letter-spacing:1px;">
                            <a href="">How does It work </a>
                        </div>

                    </li>
                <?php } ?>
                <?php foreach ($models as $model) : ?>
                <li data-index="rs-<?= $model->id ?>" data-transition="slidevertical" data-slotamount="1" data-hideafterloop="0" data-hideslideonmobile="off" data-easein="default" data-easeout="default" data-masterspeed="1500" data-rotate="0" data-fstransition="fade" data-fsmasterspeed="1500" data-fsslotamount="7" data-saveperformance="off" data-title="Intro" data-param1="" data-param2="" data-param3="" data-param4="" data-param5="" data-param6="" data-param7="" data-param8="" data-param9="" data-param10="" data-description="">
                    <!-- MAIN IMAGE -->
                    <img src="<?= $model->getPhotoUrl() ?>" alt="" data-bgposition="center center" data-bgfit="cover" data-bgrepeat="no-repeat" class="rev-slidebg" data-no-retina>
                    <div class="tp-caption WebProduct-Title-Light   tp-resizeme" id="slide-2946-layer-7" data-x="['left','left','left','left']" data-hoffset="['120','30','200','80']" data-y="['middle','middle','top','top']" data-voffset="['-210','-80','137','130']" data-fontsize="['70','70','50','50']" data-lineheight="['90','90','50','50']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="text" data-responsive_offset="on" data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1000,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 11; white-space: nowrap;">
                        <?= $model->name ?>
                    </div>
                    <div class="tp-caption WebProduct-Content-Light   tp-resizeme" id="slide-2946-layer-9" data-x="['left','left','left','left']" data-hoffset="['120','30','200','80']" data-y="['middle','middle','top','top']" data-voffset="['-30','127','300','270']" data-fontsize="['18','16','16','13']" data-lineheight="['27','27','22','22']" data-width="['448','356','334','277']" data-height="['none','none','76','68']" data-whitespace="normal" data-type="text" data-responsive_offset="on" data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1500,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[0,0,0,0]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[0,0,0,0]" style="z-index: 13; min-width: 448px; max-width: 448px; white-space: normal;">
                        <?= $model->description ?>
                    </div>
                    <?php if ($model->url) : ?>
                    <div class="tp-caption WebProduct-Button rev-btn " id="slide-2946-layer-8" data-x="['left','left','left','left']" data-hoffset="['120','30','200','80']" data-y="['middle','middle','top','top']" data-voffset="['90','268','450','400']" data-width="none" data-height="none" data-whitespace="nowrap" data-type="button" data-actions='[{"event":"click","action":"jumptoslide","slide":"rs-2948","delay":""}]' data-responsive_offset="on" data-responsive="off" data-frames='[{"from":"x:-50px;opacity:0;","speed":1000,"to":"o:1;","delay":1750,"ease":"Power2.easeOut"},{"delay":"wait","speed":1500,"to":"opacity:0;","ease":"Power4.easeIn"},{"frame":"hover","speed":"300","ease":"Linear.easeNone","to":"o:1;rX:0;rY:0;rZ:0;z:0;","style":"c:rgba(51, 51, 51, 1.00);bg:rgba(255, 255, 255, 1.00);bw:2px 2px 2px 2px;"}]' data-textAlign="['left','left','left','left']" data-paddingtop="[0,0,0,0]" data-paddingright="[40,40,40,40]" data-paddingbottom="[0,0,0,0]" data-paddingleft="[40,40,40,40]" style="z-index: 14; white-space: nowrap; letter-spacing:1px;">
                        <?= Html::a(Yii::t('app', 'Go to Detail'), Url::to($model->url, $model->is_absolute_url), []) ?>
                    </div>
                    <?php endif; ?>
                </li>
                <?php endforeach; ?>
            </ul>
        </div>
        <div class="tp-bannertimer tp-bottom" style="visibility: hidden !important;"></div>
    </div>
    <!-- END REVOLUTION SLIDER -->
</div>
<!-- slider section End -->

<!-- slider custom js Start -->
<?php

$this->registerJs("
    var tpj = jQuery;
    var revapi1052;
    tpj(document).ready(function() {
        if (tpj('#rev_slider_1052_1').revolution == undefined) {
            revslider_showDoubleJqueryError('#rev_slider_1052_1');
        } else {
            revapi1052 = tpj('#rev_slider_1052_1').show().revolution({
                sliderType: 'standard',
                jsFileLocation: '',
                sliderLayout: 'auto',
                /*dottedOverlay: 'none',*/
                delay: 5000,
                navigation: {
                    keyboardNavigation: 'off',
                    keyboard_direction: 'horizontal',
                    mouseScrollNavigation: 'off',
                    onHoverStop: 'on',
                    touch: {
                        touchenabled: 'off',
                        swipe_treshold: 75,
                        swipe_min_touches: 1,
                        drag_block_vertical: !1,
                        swipe_direction: 'horizontal'
                    },
                    arrows: {
                        style: 'uranus',
                        enable: true,
                        hide_onmobile: true,
                        hide_onleave: true,
                        tmp: '',
                        left: {
                            h_align: 'left',
                            v_align: 'center',
                            h_offset: 0,
                            v_offset: 10
                        },
                        right: {
                            top: '56',
                            h_align: 'right',
                            v_align: 'center',
                            h_offset: 0,
                            v_offset: 10
                        }
                    },
                    bullets: {
                        enable: true,
                        hide_onmobile: false,
                        hide_under: 1024,
                        style: 'hephaistos',
                        hide_onleave: false,
                        direction: 'horizontal',
                        h_align: 'center',
                        v_align: 'bottom',
                        h_offset: 0,
                        v_offset: 40,
                        space: 10,
                        tmp: ''
                    }
                },
                responsiveLevels: [1240, 1024, 778, 480],
                visibilityLevels: [1240, 1024, 778, 480],
                gridwidth: [1170, 1170, 1170, 700],
                gridheight: [635, 635, 635, 635],
                /*gridwidth: 1000,
                gridheight: 500,*/
                lazyType: 'smart',
                shadow: 0,
                spinner: 'spinner0',
                stopLoop: 'off',
                stopAfterLoops: -1,
                stopAtSlide: -1,
                shuffle: 'off',
                autoHeight: 'off',
                disableProgressBar: 'off',
                hideThumbsOnMobile: 'off',
                hideSliderAtLimit: 0,
                hideCaptionAtLimit: 0,
                hideAllCaptionAtLilmit: 0,
                debugMode: false,
                fallbacks: {
                    simplifyAll: 'off',
                    nextSlideOnWindowFocus: 'off',
                    disableFocusListener: false,
                }
            });
        }
    }); /*ready*/
", yii\web\View::POS_END);