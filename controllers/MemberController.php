<?php

namespace app\controllers;

use app\models\Member;
use app\models\MemberLoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use const YII_ENV_TEST;

class MemberController extends Controller
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
    
    public function actionIndex()
    {
        if (!\Yii::$app->member->isGuest) {
            return $this->redirect(['profile']);
        }
        
        return $this->redirect(['signin']);
    }
    
    public function actionProfile()
    {
        if (\Yii::$app->member->isGuest) {
            Yii::$app->session->setFlash('info', Yii::t('app', 'You must be login'));
            return $this->redirect(['signin']);
        }
        
        return $this->render('profile');
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionSignup()
    {
        if (!\Yii::$app->member->isGuest) {
            return $this->redirect(['profile']);
        }
        
        $model = new Member();
        
        
        return $this->render('signup', compact('model'));
    }

    /**
     * Displays contact page.
     *
     * @return string
     */
    public function actionSignin()
    {
        if (!\Yii::$app->member->isGuest) {
            return $this->redirect(['profile']);
        }
        
        $model = new MemberLoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->redirect(['/member/profile']);
        }
        
        return $this->render('signin', [
            'model' => $model,
        ]);
    }
    
    public function actionSignout()
    {
        Yii::$app->member->logout();
        return $this->redirect(['signin']);
    }
}
