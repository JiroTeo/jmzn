<?php
namespace app\index\controller;
use app\index\model\Item as itemModel;
class Defa extends Base {

    public function defa(){
        $itemModel = new itemModel();
        $hotItem = $itemModel -> getItemDataList(['status'=>1],'read_num desc','13',1);
        $this -> assign('hotItem',$hotItem);
        return view();
    }


}