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
                        'actions' => ['addcart', 'buy', 'quantity', 'removecart'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    public function actionAddcart($id, $quantity)
    {
        $product = (string)Yii::$app->request->get('id');

        $session = Yii::$app->session;
        if ($session->isActive) 
        {
            if($session->has('cart'))
            {
                $cart = $session->get('cart');
            }
            if ($quantity == null || $quantity == 0 || $quantity == "")
                $cart[$product] = 1;
            else
                $cart[$product] = $quantity;
            $session->set('cart', $cart);
        }

        \Yii::$app->session->addFlash('success', 'Produto adicionado ao seu Carrinho');

        return $this->redirect(['site/index']);
    }

    public function actionBuy($id)
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
        return $this->redirect(['site/cart']);
    }

    public function actionQuantity($id)
    {
        $quantity = Yii::$app->request->post('quantity');
        if ($quantity == null || $quantity == 0 || $quantity == "")
                $quantity = 1;

        $session = Yii::$app->session;
        if ($session->isActive) {
            $cart = [];
            if ($session->has('cart')) {
                $cart = $session->get('cart');
            }

            $cart[(string)$id] = $quantity;

            $session->set('cart', $cart);
        }

        return $this->redirect(['site/cart']);
    }

    public function actionRemovecart($id)
    {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $cart = [];
            if ($session->has('cart')) {
                $cart = $session->get('cart');
                unset($cart[$id]);
            }
            $session->set('cart', $cart);
        }

        return $this->redirect(['site/cart']);
    }

}
