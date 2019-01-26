<?php
/**
 * User: leksdashko
 */

namespace app\controllers;
use app\models\Category;
use app\models\Product;
use Yii;

class CategoryController extends AppController{

    public function actionIndex(){
        $hits = Product::find()->where(['hit' => '1'])->limit(6)->all();
        $this->setMeta('YIISHOP');
        return $this->render('index', compact('hits'));
    }

    public function actionView($id){
        $category = Category::getCurrentCategory($id);
        $this->setMeta('YIISHOP | ' . $category->name, $category->keywords, $category->description);
        $products = Product::find()->where(['category_id' => $id])->all();
        return $this->render('view', compact('products', 'category'));
    }

} 