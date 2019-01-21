<?php

namespace app\components;

use yii\base\Widget;

class MenuWidget extends Widget{
    
    public $tpl;
    public $data;
    public $tree;
    public $menuHtml;
    
    public function init(){
        parent::init();
        if($this->tpl === null){
            $this->tpl = 'menu';
        }
        $this->tpl .= '.php';
    }
    
    public function run(){
        $this->data = Category::find()->all();
        return $this->tpl;
    }
    
}
