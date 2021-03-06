<?php

namespace app\api\controllers;

use Yii;
use common\models\Sale;
use common\models\User;
use common\models\Product;
use common\models\SaleItem;
use yii\rest\ActiveController;
use yii\filters\auth\CompositeAuth;
use yii\filters\auth\HttpBasicAuth;
use yii\filters\auth\QueryParamAuth;

class SaleController extends ActiveController
{
    public $modelClass = 'common\models\Sale';

    public function behaviors()
    {
        $behaviors = parent::behaviors();
        $behaviors['authenticator'] = [
            'class' => CompositeAuth::className(),
            'except' => [],
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

    public function actions()
    {
        $actions = parent::actions();
        unset($actions['create']);
        return $actions;
    }

    public function actionCreate()
    {
        $params = Yii::$app->request->post();

        $sale = new Sale();
        $sale->id_user = Yii::$app->user->getId();
        $sale->sale_finished = 0;
        $sale->save(false);

        foreach ($params as $product)
        {
            $model = Product::findOne($product['id']);

            $orderItem = new SaleItem();
            $orderItem->id_sale = $sale->id;
            $orderItem->unit_price = $model->unit_price;
            $orderItem->id_product = $model->id;
            $orderItem->quantity = $product['quantity'];
            if (!$orderItem->save(false)) {
                $sale->getErrors();
                $response['hasErrors'] = $sale->hasErrors();
                $response['errors'] = $sale->getErrors();
                return $response;
            }
        }
        $response['message'] = 'Venda Registada com sucesso!';
        return $response;
    }
}
