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
        if(empty($category))
            throw new \yii\web\HttpException('404', 'Такой категории нет');
        
        $this->setMeta('YIISHOP | ' . $category->name, $category->keywords, $category->description);
        $query = Product::find()->where(['category_id' => $id]);
        $pages = new \yii\data\Pagination(['totalCount' => $query->count(), 'pageSize' => 3, 'forcePageParam' => false, 'pageSizeParam' => false]);
        $products = $query->offset($pages->offset)->limit($pages->limit)->all();
        return $this->render('view', compact('products', 'pages', 'category'));
    }

} 