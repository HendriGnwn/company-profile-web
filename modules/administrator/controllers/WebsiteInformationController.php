<?php

namespace app\modules\administrator\controllers;

use app\modules\administrator\models\WebsiteInformationForm;
use Yii;

class WebsiteInformationController extends BaseController
{
    public function actionIndex()
    {
        $model = new WebsiteInformationForm();
        if ($model->load(Yii::$app->request->post()) && $model->post()) {
            Yii::$app->session->setFlash('success', 'Updated');

            return $this->redirect('website-information');
        }
        
        return $this->render('index', compact('model'));
    }

}
