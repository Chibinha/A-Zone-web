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
        unset($actions['update']);
        unset($actions['delete']);
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

    public function actionLogin()
    {
        $userData = User::find()->where(['id' => Yii::$app->user->getId()])->select([
            "id",
            "username",
            "auth_key",
            "email"
        ])->asArray()->one();
        $profile = Profile::find()->where(['id_user' => Yii::$app->user->getId()])->select([
            "firstName",
            "lastName",
            "phone",
            "address",
            "nif",
            "postal_code",
            "city",
            "country"
        ])->asArray()->one();

        return array_merge($userData, $profile);
    }

    public function actionUpdate($id){

        $user = User::findOne($id);
        if (!$user) {
            throw new \yii\web\NotFoundHttpException("The user was not found.");
        }

        $profile = Profile::find()->where(['id_user' => $user->id])->One();
        if (!$profile) {
            throw new \yii\web\NotFoundHttpException("The user has no profile.");
        }

        $user->username = \Yii::$app->request->post('username');
        $user->email = \Yii::$app->request->post('email');
        $profile->firstName = \Yii::$app->request->post('firstName');
        $profile->lastName = \Yii::$app->request->post('lastName');
        $profile->phone = \Yii::$app->request->post('phone');
        $profile->address = \Yii::$app->request->post('address');
        $profile->nif = \Yii::$app->request->post('nif');
        $profile->postal_code = \Yii::$app->request->post('postal_code');
        $profile->city = \Yii::$app->request->post('city');
        $profile->country = \Yii::$app->request->post('country');

        if($user->validate() && $profile->validate()) {
            $profile->save();
            $user->save();
            
            $user = User::find()->where(['id' => $id])->select([
                "id",
                "username",
                "auth_key",
                "email"
            ])->asArray()->one();
            $profile = Profile::find()->where(['id_user' => $id])->select([
                "firstName",
                "lastName",
                "phone",
                "address",
                "nif",
                "postal_code",
                "city",
                "country"
            ])->asArray()->one();
    
            return array_merge($user, $profile);
        }
        else {
            throw new \yii\web\BadRequestHttpException("The request could not be understood by the server due to malformed syntax.");
        }       
    }

    public function actionDelete($id)
    {
        $user = User::find()->where(['id' => $id])->One();
        $user->status = 0;
        $user->save();
        
        if ($user->validate()) {
            $response['isSuccess'] = 201;
            $response['message'] = 'Utilizador registado com sucesso!';
            return $response;
        } else {
            $user->getErrors();
            $response['hasErrors'] = $user->hasErrors();
            $response['errors'] = $user->getErrors();
            return $response;
        }      
    }
}
