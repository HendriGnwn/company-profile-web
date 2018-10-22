<?php

namespace app\modules\administrator\models;

use app\models\Config;
use yii\base\Model;
use yii\helpers\Html;

/**
 * BannerSearch represents the model behind the search form about `app\models\Banner`.
 */
class WebsiteInformationForm extends Model
{
    public $app_name;
    public $app_motto;
    public $app_copyright;
    public $app_copyright_url;
    public $app_contact_email;
    public $app_contact_address;
    public $app_contact_phone;
    public $app_account_facebook;
    public $app_account_twitter;
    public $app_account_googleplus;
    public $app_seo_image_url;
    public $app_seo_alt_image;
    public $email_subject;
    public $email_admin;
    public $email_noreply;
    public $email_web_support;
    public $counter_year_of_experience;
    public $counter_project_completed;
    public $counter_happy_customers;
    public $counter_our_employees;
    public $app_metakey;
    public $app_metadesc;
    public $app_logo;
    public $progress_web_analyst;
    public $progress_web_development;
    public $progress_mobile_hybrid;
    public $progress_network_analyst;
    public $progress_network_development;
    public $app_company_name;
    public $app_favicon;
    public $app_color_primary;
    public $app_color_secondary;
    public $app_color_footer_content;
    public $app_color_footer_copyright;
    
    public $appLogoFile;
    public $appFaviconFile;
    public $appSeoImageFile;
    
    public function init() {
        $this->app_name = Config::getAppName();
        $this->app_motto = Config::getAppMotto();
        $this->app_copyright = Config::getAppCopyright();
        $this->app_copyright_url = Config::getAppCopyrightUrl();
        $this->app_contact_address = Config::getAppContactAddress();
        $this->app_contact_phone = Config::getAppContactPhone();
        $this->app_account_facebook = Config::getAppAccountFacebook();
        $this->app_account_twitter = Config::getAppAccountTwitter();
        $this->app_account_googleplus = Config::getAppAccountGooglePlus();
        $this->email_subject = Config::getEmailSubject();
        $this->app_contact_email = Config::getAppContactEmail();
        $this->email_admin = Config::getEmailAdmin();
        $this->email_noreply = Config::getEmailNoReply();
        $this->email_web_support = Config::getEmailWebSupport();
        $this->counter_year_of_experience = Config::getCounterYearOfExperience();
        $this->counter_project_completed = Config::getCounterProjectCompleted();
        $this->counter_happy_customers = Config::getCounterHappyCustomer();
        $this->counter_our_employees = Config::getCounterOurEmployee();
        $this->app_metakey = Config::getAppMetaKey();
        $this->app_metadesc = Config::getAppMetaDescription();
        $this->app_logo = Config::getAppLogo();
        $this->app_favicon = Config::getAppFavicon();
        $this->progress_web_analyst = Config::getProgressWebAnalyst();
        $this->progress_web_development = Config::getProgressWebDevelopment();
        $this->progress_mobile_hybrid = Config::getProgressMobileHybrid();
        $this->progress_network_analyst = Config::getProgressNetworkAnalyst();
        $this->progress_network_development = Config::getProgressNetworkDevelopment();
        $this->app_company_name = Config::getAppCompanyName();
        $this->app_seo_image_url = Config::getAppSeoImageUrl();
        $this->app_seo_alt_image = Config::getAppSeoAltImage();
        $this->app_color_primary = Config::getAppColorPrimary();
        $this->app_color_secondary = Config::getAppColorSecondary();
        $this->app_color_footer_content = Config::getAppColorFooterContent();
        $this->app_color_footer_copyright = Config::getAppColorFooterCopyright();
        
        return parent::init();
    }
    
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [[
                'app_name',
                'app_motto',
                'app_copyright',
                'app_copyright_url',
                'app_contact_address',
                'app_contact_phone',
                'app_account_facebook',
                'app_account_twitter',
                'app_account_googleplus',
                'email_subject',
                'email_admin',
                'email_noreply',
                'email_web_support',
                'counter_year_of_experience',
                'counter_project_completed',
                'counter_happy_customers',
                'counter_our_employee',
                'app_metakey',
                'app_metadesc',
                'app_logo',
                'progress_web_analyst',
                'progress_web_development',
                'progress_mobile_hybrid',
                'progress_network_analyst',
                'progress_network_development',
                'app_company_name',
                'app_contact_email',
                'app_seo_alt_image',
                'app_seo_image_url',
                'app_color_primary',
                'app_color_secondary',
                'app_color_footer_content',
                'app_color_footer_copyright',
            ], 
            'safe'],
            [['appLogoFile', 'appSeoImageFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => true,
                'extensions' => ['jpg', 'jpeg', 'png'],
                'maxSize' => 1024 * 1024 * 1],
            [['appFaviconFile'], 'file', 'skipOnEmpty' => true, 'checkExtensionByMimeType' => true,
                'extensions' => ['ico'],
                'maxSize' => 1024 * 1024 * 1],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
            'app_name' => 'Application Name',
            'app_motto' => 'Short About',
            'app_copyright' => 'Copyright',
            'app_copyright_url' => 'Copyright Url',
            'app_contact_address' => 'Contact Address',
            'app_contact_phone' => 'Contact Phone',
            'app_account_facebook' => 'Facebook Account Url',
            'app_account_twitter' => 'Twitter Account Url',
            'app_account_googleplus' => 'Google + Account Url',
            'email_subject' => 'Subject Email Sending',
            'email_admin' => 'Email Admin',
            'email_noreply' => 'Sender Email',
            'email_web_support' => 'Web Support Admin',
            'counter_year_of_experience' => Config::getLabelByName('counter_year_of_experience'),
            'counter_project_completed' => Config::getLabelByName('counter_project_completed'),
            'counter_happy_customers' => Config::getLabelByName('counter_happy_customers'),
            'counter_our_employee' => Config::getLabelByName('counter_our_employee'),
            'app_metakey' => 'SEO Meta Keywords',
            'app_metadesc' => 'SEO Meta Description',
            'app_logo' => 'Company Logo',
            'progress_web_analyst' => Config::getLabelByName('progress_web_analyst'),
            'progress_web_development' => Config::getLabelByName('progress_web_development'),
            'progress_mobile_hybrid' => Config::getLabelByName('progress_mobile_hybrid'),
            'progress_network_analyst' => Config::getLabelByName('progress_network_analyst'),
            'progress_network_development' => Config::getLabelByName('progress_network_development'),
            'app_company_name' => 'Leggal Company Name',
            'app_contact_email' => 'Contact Email',
            'appLogoFile' => "Logo",
            'appLogoFile' => "Favicon",
            'appSeoImageFile' => "SEO Image",
            'app_seo_alt_image' => 'SEO Alt Image'
        ];
    }

    /**
     * Sends an email to the specified email address using the information collected by this model.
     * 
     * @return bool whether the model passes validation
     */
    public function post()
    {
        if ($this->validate()) {
            Config::setValueByName('app_name', $this->app_name);
            Config::setValueByName('app_motto', $this->app_motto);
            Config::setValueByName('app_copyright', $this->app_copyright);
            Config::setValueByName('app_copyright_url', $this->app_copyright_url);
            Config::setValueByName('app_contact_email', $this->app_contact_email);
            Config::setValueByName('app_contact_address', $this->app_contact_address);
            Config::setValueByName('app_contact_phone', $this->app_contact_phone);
            Config::setValueByName('app_account_facebook', $this->app_account_facebook);
            Config::setValueByName('app_account_twitter', $this->app_account_twitter);
            Config::setValueByName('app_account_googleplus', $this->app_account_googleplus);
            Config::setValueByName('app_seo_image_url', $this->app_seo_image_url);
            Config::setValueByName('app_seo_alt_image', $this->app_seo_alt_image);
            Config::setValueByName('email_subject', $this->email_subject);
            Config::setValueByName('email_admin', $this->email_admin);
            Config::setValueByName('email_noreply', $this->email_noreply);
            Config::setValueByName('email_web_support', $this->email_web_support);
            Config::setValueByName('counter_year_of_experience', $this->counter_year_of_experience);
            Config::setValueByName('counter_project_completed', $this->counter_project_completed);
            Config::setValueByName('counter_happy_customers', $this->counter_happy_customers);
            Config::setValueByName('counter_our_employees', $this->counter_our_employees);
            Config::setValueByName('app_metakey', $this->app_metakey);
            Config::setValueByName('app_metadesc', $this->app_metadesc);
            Config::setValueByName('app_logo', $this->app_logo);
            Config::setValueByName('progress_web_analyst', $this->progress_web_analyst);
            Config::setValueByName('progress_web_development', $this->progress_web_development);
            Config::setValueByName('progress_mobile_hybrid', $this->progress_mobile_hybrid);
            Config::setValueByName('progress_network_analyst', $this->progress_network_analyst);
            Config::setValueByName('progress_network_development', $this->progress_network_development);
            Config::setValueByName('app_company_name', $this->app_company_name);
            Config::setValueByName('app_favicon', $this->app_favicon);
            Config::setValueByName('app_color_primary', $this->app_color_primary);
            Config::setValueByName('app_color_secondary', $this->app_color_secondary);
            Config::setValueByName('app_color_footer_content', $this->app_color_footer_content);
            Config::setValueByName('app_color_footer_copyright', $this->app_color_footer_copyright);
            return true;
        }
        return false;
    }
    
    public function getAppLogoHtml()
    {
        return Html::a($this->app_logo, ['/' . $this->app_logo], ['target' => '_blank']);
    }
    
    public function getAppFaviconHtml()
    {
        return Html::a($this->app_favicon, ['/' . $this->app_favicon], ['target' => '_blank']);
    }
    
    public function getAppSeoImageHtml()
    {
        return Html::a($this->app_seo_image_url, ['/' . $this->app_seo_image_url], ['target' => '_blank']);
    }
}
