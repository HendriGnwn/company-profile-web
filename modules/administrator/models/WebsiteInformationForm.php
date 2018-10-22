<?php

namespace app\modules\administrator\models;

use app\models\Config;
use yii\base\Model;

/**
 * BannerSearch represents the model behind the search form about `app\models\Banner`.
 */
class WebsiteInformationForm extends Model
{
    public $app_name;
    public $app_motto;
    public $app_copyright;
    public $app_copyright_url;
    public $app_contact_address;
    public $app_contact_phone;
    public $app_account_facebook;
    public $app_account_twitter;
    public $app_account_googleplus;
    public $email_subject;
    public $email_admin;
    public $email_noreply;
    public $email_web_support;
    public $counter_year_of_experience;
    public $counter_project_completed;
    public $counter_happy_customers;
    public $counter_our_employee;
    public $app_metakey;
    public $app_metadesc;
    public $app_logo;
    public $progress_web_analyst;
    public $progress_web_development;
    public $progress_mobile_hybrid;
    public $progress_network_analyst;
    public $progress_network_development;
    public $app_company_name;
    
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
        $this->email_admin = Config::getEmailAdmin();
        $this->email_noreply = Config::getEmailNoReply();
        $this->email_web_support = Config::getEmailWebSupport();
        $this->counter_year_of_experience = Config::getCounterYearOfExperience();
        $this->counter_project_completed = "";
        $this->counter_happy_customers = "";
        $this->counter_our_employee = "";
        $this->app_metakey = "";
        $this->app_metadesc = "";
        $this->app_logo = "";
        $this->progress_web_analyst = "";
        $this->progress_web_development = "";
        $this->progress_mobile_hybrid = "";
        $this->progress_network_analyst = "";
        $this->progress_network_development = "";
        $this->app_company_name = "";
        
        
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
            ], 
            'safe'],
        ];
    }

    /**
     * @return array customized attribute labels
     */
    public function attributeLabels()
    {
        return [
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
            return true;
        }
        return false;
    }
}
