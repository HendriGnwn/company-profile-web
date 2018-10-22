<?php

namespace app\controllers;

use app\models\BlogPost;
use app\models\Client;
use app\models\Contact;
use app\models\ContactForm;
use app\models\Page;
use app\models\search\GallerySearch;
use app\models\Subscribe;
use Yii;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;
use const YII_ENV_TEST;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'app\components\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $this->layout = '//home';
        
        $contactModel = new ContactForm();
        if ($contactModel->load(Yii::$app->request->post()) && $contactModel->contact()) {
            Yii::$app->session->setFlash('contactFormSubmitted');
            return $this->refresh('#contact');
        }
        
        $subscribe = new Subscribe();
        if ($subscribe->load(Yii::$app->request->post()) && $subscribe->save()) {
            Yii::$app->session->setFlash('SubscribeFormSubmitted');
            return $this->refresh('#subscribe-form');
        }
        
        $searchModel = new GallerySearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);
        $dataProvider->setPagination(['pageSize' => 3]); //debug
                
        $shortService = Page::findOne(['id' => Page::PAGE_SERVICE_PARTIAL, 'status' => Page::STATUS_ACTIVE]);
        
        return $this->render('index', [
            'contactModel' => $contactModel,
            'shortService' => $shortService,
            'subscribeForm' => $subscribe,
            'portfolioProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact()) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh('#contact');
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        $model = Page::findOne(Page::PAGE_ABOUT);
        
        $clients = Client::find()
                ->actived()
                ->orderBy(['name'=>SORT_ASC])
                ->all();
        
        return $this->render('about', [
            'model' => $model,
            'clients' => $clients,
        ]);
    }
    
    /**
     * displays maintenance page.
     * 
     * @return string
     */
    public function actionMaintenance()
    {
        return $this->render('maintenance');
    }
    
    public function actionTest()
    {
        $contact = Contact::findOne(1);
        
        $contact->sendEmailNewNotification();
        
        die(true);
    }
    
    /**
     * displays site map
     * 
     * @return view
     */
    public function actionSitemap()
    {
        $this->layout = false;
        Yii::$app->response->format = Response::FORMAT_RAW;
        $headers = Yii::$app->response->headers;
        $headers->add('Content-Type', 'text/xml');
        
        $pages = Page::find()->where(['category' => Page::CATEGORY_FULL])->actived()->all();
        $blogs = BlogPost::find()->actived()->all();
        
        return $this->render('sitemap', [
            'pages' => $pages,
            'blogs' => $blogs,
        ]);
    }
}
