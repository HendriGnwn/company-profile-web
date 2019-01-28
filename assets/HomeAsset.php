<?php
/**
 * @link http://www.yiiframework.com/
 * @copyright Copyright (c) 2008 Yii Software LLC
 * @license http://www.yiiframework.com/license/
 */

namespace app\assets;

use yii\web\AssetBundle;

/**
 * @author Hendri <hendri.gnw@gmail.com>
 */
class HomeAsset extends AssetBundle
{
    private $theme;
    public $basePath = '@webroot';
    public $baseUrl = '@web';
    public $depends = [
        'yii\web\YiiAsset',
        'yii\bootstrap\BootstrapAsset',
        'app\assets\FontAsset',
        'app\assets\FontAwesomeAsset',
//        'app\assets\SliderAsset',
    ];
    
    public function init() 
    {
        parent::init();
        
        $this->theme = \Yii::$app->params['activeFrontTheme'];
        
        switch ($this->theme) {
            case 'v1':
                $this->getThemeV1Assets();
                break;
            case 'v2':
                $this->getThemeV2Assets();
                break;
        }
    }
    
    /**
     * theme v1 qelopak.com
     */
    protected function getThemeV1Assets()
    {
        $this->css = [
            'themes/'.$this->theme.'/magnific-popup/magnific-popup.min.css',
            'themes/'.$this->theme.'/materialize/css/materialize.min.css',
            'themes/'.$this->theme.'/bootstrap/css/bootstrap.min.css',
            'themes/'.$this->theme.'/css/shortcodes/shortcodesae52.css?v=5',
            'themes/'.$this->theme.'/css/skins/creative.css',
            'themes/'.$this->theme.'/styleae52.css?v=5',
            'css/site.css',
        ];
        
        $this->js = [
            'themes/'.$this->theme.'/bootstrap/js/bootstrap.min.js',
            'themes/'.$this->theme.'/materialize/js/materialize.min.js',
            'themes/'.$this->theme.'/js/menuzord.min.js',
            'themes/'.$this->theme.'/js/bootstrap-tabcollapse.min.js',
            'themes/'.$this->theme.'/js/jquery.easing.min.js',
            'themes/'.$this->theme.'/js/jquery.sticky.min.js',
            'themes/'.$this->theme.'/js/smoothscroll.min.js',
            'themes/'.$this->theme.'/js/imagesloaded.min.js',
            'themes/'.$this->theme.'/js/jquery.stellar.min.js',
            'themes/'.$this->theme.'/js/jquery.inview.min.js',
            'themes/'.$this->theme.'/js/jquery.shuffle.min.js',
            'themes/'.$this->theme.'/magnific-popup/jquery.magnific-popup.min.js',
            'themes/'.$this->theme.'/js/twitterFetcher.min.js',
            'themes/'.$this->theme.'/js/scriptsae52.js?v=5',
        ];
    }
    
    /**
     * theme v2 future template
     */
    protected function getThemeV2Assets()
    {
        $this->css = [
            'themes/'.$this->theme.'/css/fonts.css',
            'themes/'.$this->theme.'/materialize/css/materialize.min.css',
            'themes/'.$this->theme.'/css/bootstrap.min.css',
            'themes/'.$this->theme.'/css/animate.css',
            'themes/'.$this->theme.'/js/plugin/rs_slider/layers.css',
            'themes/'.$this->theme.'/js/plugin/rs_slider/navigation.css',
            'themes/'.$this->theme.'/js/plugin/rs_slider/settings.css',
            'themes/'.$this->theme.'/css/owl.theme.default.css',
            'themes/'.$this->theme.'/css/owl.carousel.css',
            'themes/'.$this->theme.'/css/magnific-popup.css',
            'themes/'.$this->theme.'/css/homepage_style_2.css',
            'themes/'.$this->theme.'/css/custom.css',
        ];
        
        $this->js = [
            'themes/'.$this->theme.'/js/bootstrap.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/jquery.themepunch.revolution.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/jquery.themepunch.tools.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.addon.snow.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.extension.actions.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.extension.carousel.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.extension.kenburn.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.extension.layeranimation.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.extension.migration.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.extension.navigation.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.extension.parallax.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.extension.slideanims.min.js',
            'themes/'.$this->theme.'/js/plugin/rs_slider/revolution.extension.video.min.js',
            'themes/'.$this->theme.'/js/jquery.shuffle.min.js',
            'themes/'.$this->theme.'/js/jquery.inview.min.js',
            'themes/'.$this->theme.'/js/jquery.easypiechart.min.js',
            'themes/'.$this->theme.'/js/jquery.magnific-popup.js',
            'themes/'.$this->theme.'/js/owl.carousel.js',
            'themes/'.$this->theme.'/js/wow.js',
            'themes/'.$this->theme.'/js/portfolio.js',
            'themes/'.$this->theme.'/js/homepage.js',
            'themes/'.$this->theme.'/js/custom.js',
        ];
    }
}