<?php

namespace app\api\controllers;
use common\models\Product;
use common\models\User;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

use Yii;
use yii\rest\ActiveController;

class ProductController extends ActiveController
{
    public $modelClass = 'common\models\Product';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['index', 'view', 'productsbyname'],
            'authMethods' => [
                [
                    'class' => HttpBasicAuth::className(),
                    'auth' => function ($username, $password)
                    {
                        $user = User::findByUsername($username);
                        if ($user && $user->validatePassword($password))
                        {
                            return $user;
                        }
                    }
                ],
                QueryParamAuth::className(),
            ],
        ];
        return $behaviors;
    }

    public function actions() {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    public function actionIndex() {
        return Product::find()->all();
    }

     //http://localhost:8081/api/products/name/{name}
     public function actionProductsbyname($name)
     {
         $productmodel = Product::find()->where(['like', 'product_name', $name])->limit(12)->orderBy(['id' => SORT_DESC])->asArray()->all();
         return ['product' => $productmodel];
     }
}