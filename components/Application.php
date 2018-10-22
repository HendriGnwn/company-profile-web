<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\components;

use app\models\Config;
use yii\helpers\ArrayHelper;

/**
 * Description of Application
 *
 * @author Hendri
 */
class Application extends \yii\web\Application
{
	public function init() {
		parent::init();
		
		$this->name = Config::getAppName();
        
		return true;
	}
    
    public function run() 
    {
        $this->view->registerMetaTag([
            'name' => 'google-site-verification',  
            'content' => '1-WO1CGauPMJEz_cuMPQe-YbfXmfyEJta2g33z0Avxk'
        ]);
        $this->view->registerMetaTag([
            'name' => 'msvalidate.01',  
            'content' => 'AEAF074EB5D345C076DDD01EE29E77E3'
        ]);
        
        $configs = Config::getByNames([
            'credential_googlemap_api',
            'map_location_latitude',
            'map_location_longitude',
            'map_marker_description',
        ]);
        $configs['map_location_latitude'] = (float) $configs['map_location_latitude'];
        $configs['map_location_longitude'] = (float) $configs['map_location_longitude'];

        $this->params = ArrayHelper::merge($this->params, $configs);
        
        $connection = \Yii::$app->getDb();
        $command = $connection->createCommand("
            SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))
            ");

        $result = $command->execute();
        
//        $this->view->registerCss("
//           .top-bar, .blog_section .blog-post-wrapper .post-thumbnail .posted-date {
//                background-color: ".Config::getAppColorPrimary().";
//            }
//            .signin_wrapper, #return-to-top {
//                background-color: ".Config::getAppColorPrimary().";
//            }
//            .navbar-default .navbar-nav>.active>a, 
//            .navbar-default .navbar-nav>.active>a:focus, 
//            .navbar-default .navbar-nav>.active>a:hover, 
//            .portfolio_img_text a, 
//            .copyright_content a {
//                color: ".Config::getAppColorPrimary().";
//            }
//            .tp-caption.WebProduct-Button, .WebProduct-Button {
//                border-color: ".Config::getAppColorPrimary().";
//                background-color: ".Config::getAppColorPrimary().";
//            }
//            .tp-leftarrow, .tp-rightarrow {
//                border: 1px solid ".Config::getAppColorPrimary().";
//                background-color: ".Config::getAppColorPrimary().";
//            }
//            .icon_text:hover, #filter li a:hover, #filter li a.active {
//                border-color: ".Config::getAppColorPrimary().";
//            }
//            .portfolio_img_text a:hover, .comments_form_section .btn-primary {
//                border: 1px solid ".Config::getAppColorPrimary().";
//                background-color: ".Config::getAppColorPrimary().";
//            }
//            .comments_form_section .btn-primary.focus, .comments_form_section .btn-primary:hover {
//                background-color: transparent;
//                color: ".Config::getAppColorPrimary().";
//            }
//            .counterFour {
//                background-color: ".Config::getAppColorSecondary().";
//            }
//            .footer_wrapper_second h4:after {
//                border: 2px solid ".Config::getAppColorPrimary().";
//            }
//            .footer {
//                background-color: ".Config::getAppColorFooterContent().";
//            }
//            .copyright_wrapper {
//                background-color: ".Config::getAppColorFooterCopyright().";
//            }
//            .dropdown-menu li a:hover, .dropdown-menu>li>a:focus, .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
//                color: ".Config::getAppColorPrimary().";
//            }
//            .dropdown-menu {
//                border-top: 4px solid ".Config::getAppColorPrimary().";
//            }
//            .icon_text:hover .icon_text_effect {
//                border: 2px solid ".Config::getAppColorPrimary().";
//            }
//            .icon_text:hover .fa, #filter li a:hover, #filter li a.active, .signin_wrapper:hover, .signin_wrapper .signin_dropdown .btn, .signin_wrapper .signin_dropdown .btn:hover {
//                background-color: ".Config::getAppColorPrimary().";
//            }
//            .social_icon_wrapper ul li a {
//                color: white;
//            }
//        ");
        
        return parent::run();
    }
}
