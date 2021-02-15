<?php

namespace app\api\controllers;

use Yii;
use yii\web\Controller;
use yii\helpers\Html;

class ImageController extends Controller
{
    public function actionIndex($name)
    {
        \Yii::$app->response->format = yii\web\Response::FORMAT_RAW;
        \Yii::$app->response->headers->add('content-type', 'image/png');
        \Yii::$app->response->data = file_get_contents(Yii::getAlias("@frontend/web/Images/") . $name);
        return \Yii::$app->response;
    }
}