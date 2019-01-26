<?php
/**
 * User: leksdashko
 */

namespace app\models;
use yii\db\ActiveRecord;


class Category extends ActiveRecord{

    public static function tableName(){
        return 'category';
    }
    
    public static function getCurrentCategory($id){
        $category = parent::findOne($id);
        return $category;
    }

    public function getProducts(){
        return $this->hasMany(Product::className(), ['category_id' => 'id']);
    }
    
    

} 