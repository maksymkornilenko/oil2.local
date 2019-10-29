<?php

namespace app\controllers;

use Yii;
use yii\web\Controller;
use app\models\Orders;
use app\models\OrderForm;

class SiteController extends Controller
{

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $orderForm = new Orders();
        if ($orderForm->load(Yii::$app->request->post())) {
            if ($orderForm->save()) {
                return $this->redirect('/order-success');
            } else {
                return $this->redirect('/order-error');
            }
        }
        return $this->render('index', ['orderForm' => $orderForm, 'mainPage' => true]);
    }

    public function actionOrderSuccess()
    {
        return $this->render('orderSuccess', []);
    }

    public function actionOrderError()
    {
        return $this->render('orderError', []);
    }

    public function actionError()
    {
        $exception = Yii::$app->errorHandler->exception;
        if ($exception !== null) {
            if ($exception->statusCode == 404)
                return $this->render('error404', ['exception' => $exception]);
            else
                return $this->render('error', ['exception' => $exception]);
        }
    }
}