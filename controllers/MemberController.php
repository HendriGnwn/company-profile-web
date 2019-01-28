<?php

namespace app\controllers;

use app\models\Banner;
use app\models\Member;
use app\models\MemberForgotPasswordForm;
use app\models\MemberLoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use const YII_ENV_TEST;

class MemberController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'except' => ['signup', 'signin', 'forgot-password'],
                'user' => 'member',
                'rules' => [
                    [
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
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
        
        $model = Member::findOne(Yii::$app->member->id);
        
        return $this->render('profile', compact('model'));
    }
    
    public function actionPhoto()
    {
        $model = $this->findModel();
        
        return $this->render('photo', compact('model'));
    }
    
    public function actionUpdateProfile()
    {
        $model = $this->findModel();
        Yii::$app->session->setFlash('info', Yii::t('app', 'untuk perubahan data profile silahkan hubungi dewan pengurus pusat lembaga persaudaraan anak nusantara'));
        if ($model->load(Yii::$app->request->post())) {
            $model->photoFile = UploadedFile::getInstance($model, 'photoFile');
            $model->idCardPhotoFile = UploadedFile::getInstance($model, 'idCardPhotoFile');
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Update Profile Berhasil');
                return $this->redirect(['/member/profile']);
            }
        }
        
        return $this->render('update-profile', compact('model'));
    }
    
    public function actionChangePassword()
    {
        $model = $this->findModel();
        $model->setScenario(Member::SCENARIO_CHANGE_PASSWORD);
        
        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', 'Ubah password berhasil');
            return $this->redirect(['/member/change-password']);
        }
        
        return $this->render('change-password', compact('model'));
    }
    
    public function actionForgotPassword()
    {
        if (!\Yii::$app->member->isGuest) {
            return $this->redirect(['profile']);
        }
        
        $model = new MemberForgotPasswordForm();
        
        if ($model->load(Yii::$app->request->post()) && $model->send()) {
            Yii::$app->session->setFlash('success', 'Silahkan cek email Anda');
            return $this->redirect(['/member/forgot-password']);
        }
        
        return $this->render('forgot-password', compact('model'));
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
        $model->setScenario(Member::SCENARIO_REGISTER);
        
        if ($model->load(Yii::$app->request->post())) {
            $model->photoFile = UploadedFile::getInstance($model, 'photoFile');
            $model->idCardPhotoFile = UploadedFile::getInstance($model, 'idCardPhotoFile');
            
            if ($model->save()) {
                Yii::$app->session->setFlash('success', 'Anda berhasil daftar, silahkan cek email notifikasi dan Anda dapat login');
                return $this->redirect(['signup']);
            }
        }
        
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
    
    /**
     * Finds the Banner model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Banner the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel()
    {
        if (($model = Member::findOne(Yii::$app->member->id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
