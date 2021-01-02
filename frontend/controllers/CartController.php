<?php

namespace frontend\controllers;

use Yii;
use common\models\Product;
use common\models\ProductSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * CategoryController implements the CRUD actions for Category model.
 */
class CartController extends Controller
{
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['addcart'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionAddcart($id)
    {
        $product = (string)Yii::$app->request->get('id');

        $session = Yii::$app->session;
        if ($session->isActive) 
        {
            if($session->has('cart'))
            {
                $cart = $session->get('cart');
            }
                $cart[$product] = 1;
            $session->set('cart', $cart);
        }

        \Yii::$app->session->addFlash('success', 'Produto adicionado ao seu Carrinho');

        return $this->redirect(['site/index']);
    }

    public function actionBuy($id)
    {
        Addcart($id);
        return $this->redirect(['site/cart']);
    }

}
