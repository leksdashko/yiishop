<?php

namespace app\controllers;

use app\models\Product;
use app\models\Cart;
use yii\helpers\Html;
use Yii;

/**
 * Description of CartController
 *
 * @author leksdashko
 */
class CartController extends AppController{
    
    public function actionAdd($id = null, $qty = null){
        $id = (int)Html::encode(trim($id));
        $qty = !(int)$qty ? 1 : $qty;
        $product = Product::findOne($id);
        if(empty($product)) return false;
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->addToCart($product, $qty);
        if(!Yii::$app->request->isAjax){
            return $this->redirect(Yii::$app->request->referrer);
        }
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionClear(){
        $session = Yii::$app->session;
        $session->open();
        $session->remove('cart');
        $session->remove('cart.qty');
        $session->remove('cart.sum');
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionDelItem($id){
        $session = Yii::$app->session;
        $session->open();
        $cart = new Cart();
        $cart->removeFromCart($id);
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    
    public function actionShow(){
        $session = Yii::$app->session;
        $session->open();
        $this->layout = false;
        return $this->render('cart-modal', compact('session'));
    }
    
}
