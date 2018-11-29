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
        date_default_timezone_set('Asia/Jakarta');
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
        $configs['mail_noreply'] = Config::getEmailNoReply();

        $this->params = ArrayHelper::merge($this->params, $configs);
        
        // $connection = \Yii::$app->getDb();
        // $command = $connection->createCommand("
        //     SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''))
        //     ");

        $this->styleThemes();
        // $result = $command->execute();
        return parent::run();
    }
    
    public function styleThemes()
    {
        $colorPrimary = Config::getAppColorPrimary();
        $backgroundPrimary = Config::getAppBackgroundPrimary();
        $colorSecondary = Config::getAppColorSecondary();
        $backgroundSecondary = Config::getAppBackgroundSecondary();
        $colorFooterContent = Config::getAppColorFooterContent();
        $backgroundFooterContent = Config::getAppBackgroundFooterContent();
        $colorFooterCopyright = Config::getAppColorFooterCopyright();
        $backgroundFooterCopyright = Config::getAppBackgroundFooterCopyright();
        
        // primary
        $this->view->registerCss("
            .header .top-bar {
                background-color: $backgroundPrimary;
            }
            .header .top-bar a {
                color: $colorPrimary;
            }
            .signin_wrapper {
                background-color: $backgroundPrimary;
                color: $colorPrimary;
                opacity: 0.9;
            }
            .signin_wrapper:hover {
                background-color: $backgroundPrimary;
                color: $colorPrimary;
                opacity: 1;
            }
            .navbar-default .navbar-nav>.active>a, .navbar-default .navbar-nav>.active>a:focus, .navbar-default .navbar-nav>.active>a:hover {
                color: $backgroundPrimary;
            }
            .navbar-default .navbar-nav>li>a:focus, .navbar-default .navbar-nav>li>a:hover {
                color: $backgroundPrimary;
            }
            .dropdown-menu li a:hover, .dropdown-menu>li>a:focus {
                color: $backgroundPrimary;
            }
            .dropdown-menu {
                border-top: 4px solid $backgroundPrimary;
            }
            .icon_text:hover {
                border-color: $backgroundPrimary;
            }
            .icon_text:hover .icon_text_effect {
                border: 2px solid $backgroundPrimary;
            }
            .icon_text:hover .fa { 
                background-color: $backgroundPrimary;
            }
            #filter li a:hover, #filter li a.active {
                color: $colorPrimary;
                border: 1px solid $backgroundPrimary;
                background-color: $backgroundPrimary;
            }
            .portfolio_img_text a {
                color: $backgroundPrimary;
                border: 1px solid $colorPrimary;
                background-color: $colorPrimary;
            }
            .portfolio_img_text a:hover {
                background-color: $backgroundPrimary;
                border: 1px solid $backgroundPrimary;
                color: $colorPrimary;
            }
            .port_menu_wrapper .portfolio_img_overlay::after {
                border: 1px solid $colorPrimary;
            }
            .blog_section .blog-post-wrapper .post-thumbnail .posted-date {
                background-color: $backgroundPrimary;
                color: $colorPrimary;
            }
            .blog_section .blog-post-wrapper .entry-footer a:hover {
                background-color: $backgroundPrimary;
                color: $colorPrimary;
            }
            .blog_section .blog-post-wrapper .entry-header .entry-meta li a:hover {
                color: $backgroundPrimary;
            }
            .comments_form_section .form-control:focus,
            .signin_wrapper .signin_dropdown .form-control:focus,
            .login_wrapper .form-control:focus {
                border: 1px solid $backgroundPrimary !important;
            }
            .comments_form_section .btn-primary.focus, .comments_form_section .btn-primary:hover {
                color: $backgroundPrimary;
                border: 1px solid $backgroundPrimary !important;
            }
            .comments_form_section .btn-primary {
                border: 1px solid $backgroundPrimary !important;
                background-color: $backgroundPrimary;
            }
            .wrapper_second_useful ul li a:hover {
                color: $backgroundPrimary;
            }
            #return-to-top {
                background-color: $backgroundPrimary;
                color: $colorPrimary;
            }
            .section3_img_overlay {
                background-color: $backgroundPrimary;
            }
            .page_header .sub_title a:hover, 
            .page_header .sub_title li:last-child {
                color: $backgroundPrimary;
            }
            .clientOneSlider .owl-theme .owl-nav .owl-prev:hover, .clientOneSlider .owl-theme .owl-nav .owl-next:hover {
                background-color: $backgroundPrimary;
            }
            .section3_social_icons li a:hover {
                color: $backgroundPrimary;
            }
            .gb_icon_wrapper:hover .gb_icon_img {
                background-color: $backgroundPrimary;
                border: 1px solid $backgroundPrimary;
            }
            .tags a:hover,
            .tags i,
            .archives_wrapper ul li:hover a, .archives_wrapper ul li:hover i {
                color: $backgroundPrimary;
            }
            .share_icons a:hover {
                background-color: $backgroundPrimary;
            }
            .blog_text h5 a:hover {
                color: $backgroundPrimary;
            }
            .tag_cloud_wrapper ul li a:hover, .tag_cloud_wrapper ul li.active a {
                background-color: $backgroundPrimary;
                border: 1px solid $backgroundPrimary;
            }
            .search_form button i, 
            .signin_wrapper .dropdown-menu li .sign_up_message a {
                color: $backgroundPrimary;
            }
            .signin_wrapper .signin_dropdown .btn,
            .login_wrapper .btn {
                background-color: $backgroundPrimary;
                border: 1px solid $backgroundPrimary;
                color: $colorPrimary;
            }
            
            .signin_wrapper .signin_dropdown .btn:hover,
            .login_wrapper .btn:hover {
                background-color: transparent;
                border: 1px solid $backgroundPrimary;
                color: $backgroundPrimary;
            }
            .sign_up_message a {
                color: $backgroundPrimary;
            }
            .nav-tabs.nav-justified>.active>a, .nav-tabs.nav-justified>.active>a:focus, .nav-tabs.nav-justified>.active>a:hover {
                color: $backgroundPrimary;
            }
            .tp-caption.WebProduct-Button, .WebProduct-Button {
                background-color: $backgroundPrimary;
                border-color: $backgroundPrimary;
            }
            .tp-caption.WebProduct-Button a, .WebProduct-Button a {
                color: $colorPrimary;
            }
            .tp-caption.WebProduct-Button a:hover, .WebProduct-Button a:hover,
            .tp-caption.WebProduct-Button:hover > a, .WebProduct-Button:hover > a {
                color: $backgroundPrimary;
            }
            .tp-leftarrow, .tp-rightarrow {
                border: 1px solid $backgroundPrimary;
            }
            .blog_section .blog-post-wrapper .entry-title a:hover {
                color: $backgroundPrimary;
            }
            .nav-pills > li.active > a, .nav-pills > li.active > a:hover, .nav-pills > li.active > a:focus {
                background-color: $backgroundPrimary;
                color: $colorPrimary;
            }
            .btn2 {
                background-color: $backgroundPrimary;
                border: 1px solid $backgroundPrimary;
                color: $colorPrimary;
            }
            .btn2:hover {
                background-color: transparent;
                border: 1px solid $backgroundPrimary;
                color: $backgroundPrimary;
            }
            .dropdown-menu > .active > a, .dropdown-menu > .active > a:hover, .dropdown-menu > .active > a:focus {
                background-color: $backgroundPrimary;
                color: $colorPrimary;
            }
        ");
        
        // secondary
        $this->view->registerCss("
            a {
                color: $colorSecondary;
            }
            a:focus, a:hover {
                color: $backgroundPrimary;
            }
            .counterFour {
                background-color: $backgroundSecondary;
            }
            .counterFour .count-description {
                color: $colorSecondary;
            }
        ");
        
        // footer content
        $this->view->registerCss("
            .footer {
                background-color: $backgroundFooterContent;
            }
            .footer_wrapper_second h4, .footer_wrapper_second p, .footer_wrapper_second .blog_date {
                color: $colorFooterContent;
            }
            .wrapper_second_useful ul li a {
                color: $colorFooterContent;
            }
            .footer_wrapper_second h4:after,
            .sidebar_widget h4:after {
                border: 2px solid $backgroundPrimary;
            }
            .aboutus_link a {
                color: $colorFooterContent;
            }
            .aboutus_link i {
                color: $colorFooterContent;
            }
            .wrapper_second_contact ul li i {
                color: $backgroundPrimary;
            }
            .wrapper_second_contact ul li a {
                color: $colorFooterContent;
            }
            .blog_date i {
                color: $backgroundPrimary;
            }
            .footer .blog_text h5 a {
                color: $colorFooterContent;
            }
        ");
        
        // footer copyright
        $this->view->registerCss("
            .copyright_wrapper {
                background-color: $backgroundFooterCopyright;
            }
            .copyright_wrapper p {
                color: $colorFooterCopyright;
            }
            .copyright_content a {
                color: $colorPrimary;
            }
            .copyright_content a:hover {
                color: $backgroundPrimary;
            }
        ");
    }
}
