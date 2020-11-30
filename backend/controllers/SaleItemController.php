<?php

namespace backend\controllers;

use Yii;
use common\models\SaleItem;
use common\models\SaleItemSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;

/**
 * SaleItemController implements the CRUD actions for SaleItem model.
 */
class SaleItemController extends Controller
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'rules' => [
                    [
                        'actions' => ['removeitem'],
                        'allow' => true,
                        'roles' => ['admin' , 'worker'],
                    ],
                ],
            ],
        ];
    }
   
    /**
     * Finds the SaleItem model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return SaleItem the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = SaleItem::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function actionRemoveitem($id)
    {
        $sale_item = $this->findModel($id);
        $sale_item->delete();
        
        return $this->redirect(['sale/update','id'=>$sale_item->id_sale]);
    }
}
