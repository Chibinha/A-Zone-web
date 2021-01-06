<?php

namespace app\api\controllers;

use Yii;
use yii\rest\ActiveController;
use common\models\User;
use common\models\Profile;
use frontend\models\SignupForm;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class UserController extends ActiveController
{
    public $modelClass = 'common\models\User';


    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['signup'],
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password) {
                        $user = User::findByUsername($username);
                        if ($user && $user->validatePassword($password)) {
                            return $user;
                        }
                    }
                ],
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['signup']);
        return $actions;
    }
    
    public function actionSignup()
    {
        $model = new SignupForm();
        $params = Yii::$app->request->post();
        $model->username = $params['username'];
        $model->email = $params['email'];
        $model->password = $params['password'];

        $model->firstName = $params['firstName'];
        $model->lastName = $params['lastName'];
        $model->phone = $params['phone'];
        $model->address = $params['address'];
        $model->nif = $params['nif'];
        $model->postal_code = $params['postal_code'];
        $model->city = $params['city'];
        $model->country = $params['country'];

        if ($model->signup()) {
            $response['isSuccess'] = 201;
            $response['message'] = 'Utilizador registado com sucesso!';
            return $response;
        } else {
            $model->getErrors();
            $response['hasErrors'] = $model->hasErrors();
            $response['errors'] = $model->getErrors();
            return $response;
        }
    }
}
