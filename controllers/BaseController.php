<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace app\controllers;

use yii\web\Controller;

/**
 * Parent Class
 *
 * @author Hendri
 */
class BaseController extends Controller
{
	/**
	 * @inheritdoc
	 */
	public function behaviors()
	{
		return [];
	}
}
