<?php

namespace frontend\controllers;

use Yii;
use common\models\Sale;
use common\models\SaleSearch;
use common\models\SaleItemSearch;
use common\models\Profile;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use common\models\Product;
use common\models\SaleItem;

/**
 * SaleController implements the CRUD actions for Sale model.
 */
class SaleController extends Controller
{
    /**
     * {@inheritdoc}
     */
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
                        'actions' => ['index', 'view', 'create'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
        ];
    }

    /**
     * Lists all Sale models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new SaleSearch();
        $dataProvider = $searchModel->search(['sale_finished' => 0]); 
        $user_sales = Sale::find()->where(['id_user' => Yii::$app->user->id])->all();

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
            'user_sales' => $user_sales,
        ]);
    }

    /**
     * Displays a single Sale model.
     * @param integer $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $sale = $this->findModel($id);
        $buyer = Profile::find()->where(['id_user' => $sale->id_user])->one();
        $sale_items = $sale->saleItems;

        return $this->render('view', [
            'sale' => $sale,
            'buyer' => $buyer,
            'sale_items' => $sale_items,
        ]);
    }

    public function actionCreate()
    {
        $session = Yii::$app->session;
        if ($session->isActive) {
            $cart = [];
            if ($session->has('cart') && $session->has('cart') != []) 
            {
                $cart = $session->get('cart');
            }
            else
            {
                \Yii::$app->session->addFlash('error', 'Não é possivel fazer encomenda sem items no carrinho.');
                return $this->redirect(['site/cart']);
            }
        }

        $sale = new Sale();
        $sale->id_user = Yii::$app->user->getId();
        $sale->sale_finished = 0;
        $sale->save(false);

        foreach ($cart as $item => $quantity) {
            $product = Product::findOne($item);

            $orderItem = new SaleItem();
            $orderItem->id_sale = $sale->id;
            $orderItem->unit_price = $product->unit_price;
            $orderItem->id_product = $item;
            $orderItem->quantity = $quantity;
            if (!$orderItem->save(false)) {
                \Yii::$app->session->addFlash('error', 'Não foi possivel gravar a sua encomenda.');
                return $this->redirect('site/cart');
            }
        }

        Yii::$app->session->remove('cart');

        return $this->redirect(['site/finish-sale']);
    }

    /**
     * Finds the Sale model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Sale the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Sale::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }
}
