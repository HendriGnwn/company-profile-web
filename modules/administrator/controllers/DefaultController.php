<?php

namespace app\modules\administrator\controllers;

use app\models\LoginForm;
use Yii;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;

/**
 * Default controller for the `administrator` module
 */
class DefaultController extends BaseController
{
	public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'allow' => true,
                        'actions' => ['login'],
                    ],
                    [
                        'actions' => ['logout'],
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
                'class' => 'yii\web\ErrorAction',
            ],
        ];
    }
	
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        $members = \app\models\Member::find()->count();
        $activedMembers = \app\models\Member::find()
                ->where([
                    'status' => \app\models\Member::STATUS_ACTIVE
                ])
                ->count();
        
        $counterVisitor = \app\models\Config::getCounterVisitor();
        $counterWebsiteAge = \app\models\Config::getCounterWebsiteAge();
        $statisticsDisk = \app\models\Config::getStatisticsDiskUsage();
        $statisticsCpu = \app\models\Config::getStatisticsCpuUsage();
        $statisticsRam = \app\models\Config::getStatisticsRamUsage();
        $statisticsBandwidth = \app\models\Config::getStatisticsBandwidth();
        
        if ($statisticsDisk->value < 60) {
            $statisticsDiskProgressClass = 'progress-bar-success';
        } else if ($statisticsDisk->value >= 60 && $statisticsDisk->value <= 90) {
            $statisticsDiskProgressClass = 'progress-bar-warning';
        } else {
            $statisticsDiskProgressClass = 'progress-bar-danger';
        }
        
        if ($statisticsCpu->value < 60) {
            $statisticsCpuProgressClass = 'progress-bar-success';
        } else if ($statisticsCpu->value >= 60 && $statisticsCpu->value <= 90) {
            $statisticsCpuProgressClass = 'progress-bar-warning';
        } else {
            $statisticsCpuProgressClass = 'progress-bar-danger';
        }
        
        if ($statisticsRam->value < 60) {
            $statisticsRamProgressClass = 'progress-bar-success';
        } else if ($statisticsRam->value >= 60 && $statisticsRam->value <= 90) {
            $statisticsRamProgressClass = 'progress-bar-warning';
        } else {
            $statisticsRamProgressClass = 'progress-bar-danger';
        }
        
        if ($statisticsBandwidth->value < 60) {
            $statisticsBandwidthProgressClass = 'progress-bar-success';
        } else if ($statisticsDisk->value >= 60 && $statisticsBandwidth->value <= 90) {
            $statisticsBandwidthProgressClass = 'progress-bar-warning';
        } else {
            $statisticsBandwidthProgressClass = 'progress-bar-danger';
        }
        
        return $this->render('index', [
            'members' => $members,
            'activedMembers' => $activedMembers,
            'counterVisitor' => $counterVisitor,
            'counterWebsiteAge' => $counterWebsiteAge,
            'statisticsDisk' => $statisticsDisk,
            'statisticsCpu' => $statisticsCpu,
            'statisticsRam' => $statisticsRam,
            'statisticsBandwidth' => $statisticsBandwidth,
            'statisticsDiskProgressClass' => $statisticsDiskProgressClass,
            'statisticsCpuProgressClass' => $statisticsCpuProgressClass,
            'statisticsRamProgressClass' => $statisticsRamProgressClass,
            'statisticsBandwidthProgressClass' => $statisticsBandwidthProgressClass,
        ]);
    }
	
	/**
     * Login action.
     *
     * @return string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->redirect(['default/index']);
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect(['default/index']);
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }
	
	/**
     * Logout action.
     *
     * @return string
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return Yii::$app->user->loginRequired();
    }
}
