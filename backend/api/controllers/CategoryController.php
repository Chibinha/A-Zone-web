<?php

namespace app\api\controllers;


use Yii;
use yii\rest\ActiveController;
use common\models\User;
use common\models\Category;
use common\models\Product;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class CategoryController extends ActiveController
{
    public $modelClass = 'common\models\Category';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => ['index','products'],
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
        return Category::find()->all();
    }

    //http://localhost:8080/api/categories/{id}/products
    public function actionProducts($id)
    {
        $cat_ids = Category::find()->select('id')->where(['parent_id' => $id])->asArray()->all();
        $ids = [];
        foreach($cat_ids as $value)
        {
            $ids[] = $value['id'];
        }
        $ids = implode(',',$ids);

        if ($ids != null)
        {
            return $categories = Product::find()->where('id_category IN ('.$ids.','.$id.')')->all();
        }
        else
        {
            $ids = 0;
            return $categories = Product::find()->where('id_category IN ('.$ids.','.$id.')')->all();
        }        
    }
}
