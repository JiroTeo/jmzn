<?php
namespace app\common\model;

use think\Model;

class Area extends Model{
    private $areaModel; //

    //
    public function __construct(){
        parent::__construct();
        $this -> areaModel = db('area');
    }
    /*  获取省市
     *  $param {Array} where
     * **/
    public function getAreaDataList($where = false, $order = false , $type = false ){
        $data = $this -> areaModel -> where($where) -> order($order) -> select();
        switch ($type) {
            case 1:
                $dataList = $this -> formatAreaDataListByNameAndId($data);
                break;

            default:
                # code...
                break;
        }
    }

    public function formatAreaDataListByNameAndId($data){
        foreach ($data as $key => $value) {
            $dataList[$key]['cityname'] = $value['cityname'];
            $dataList[$key]['cityname'] = $value['cityname'];
        }
    }

}