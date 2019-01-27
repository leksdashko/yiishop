<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * Description of Cart
 *
 * @author leksdashko
 */
class Cart extends ActiveRecord{
    
    public function addToCart(Product $product, $qty = 1){
        if(isset($_SESSION['cart'][$product->id])){
            $_SESSION['cart'][$product->id]['qty'] += $qty;
        }else{
            $_SESSION['cart'][$product->id] = [
                'qty' => $qty,
                'name' => $product->name,
                'price' => $product->price,
                'img' => $product->img
            ];
        }
        $_SESSION['cart.qty'] = isset($_SESSION['cart.qty']) ? $_SESSION['cart.qty'] + $qty : $qty;
        $_SESSION['cart.sum'] = isset($_SESSION['cart.sum']) ? $_SESSION['cart.sum'] + $qty * $product->price : $qty * $product->price;
    }
    
    public function removeFromCart($productId){
        if(!isset($_SESSION['cart'][$productId])) return false;
        $qtyMinus = $_SESSION['cart'][$productId]['qty'];
        $sumMinus = $_SESSION['cart'][$productId]['qty'] * $_SESSION['cart'][$productId]['price'];
        $_SESSION['cart.qty'] -= $qtyMinus;
        $_SESSION['cart.sum'] -= $sumMinus;
        unset($_SESSION['cart'][$productId]);
    }
    
}
