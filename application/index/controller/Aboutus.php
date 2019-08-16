<?php
namespace app\index\controller;
class aboutus extends Base{

    private $artModel;

    public function __construct(){
        // 实例化y用户模型
        $this->artModel = model('article');
    }

    /*关于我们*/
    public function about_us(){
        $returnLog = config('RETURNLOG');
        $where['status'] = 1;
        $data = db('group') -> where($where) -> select();
        foreach ($data as $key => $value) {
            $data[$key]['name'] = $value['name'];
            $data[$key]['img'] = 'https://'.$_SERVER['SERVER_NAME'].ltrim($value['img'],'.');
            $data[$key]['href'] = 'https://www.jiamengzhinan.com';
        }
        $dataList = $returnLog['SUCCESS'][0];
        $dataList['data'] = $data;
        wapReturn($dataList);
    }

    /*意见反馈*/
    public function propose(){
        $returnLog = config('RETURNLOG');
        $add['propose'] = $_REQUEST['propose'];
        $add['phone'] = $_REQUEST['phone'];
        $add['name'] = $_REQUEST['name'];
        $add['addtime'] = time();
        $res = db('aboutus') -> insertGetId($add);
        if($res){
            $dataList = $returnLog['SUCCESS'][0];
        }else{
            $dataList = $returnLog['ERROR'][2];
        }
        wapReturn($dataList);
    }

    /*静态页面*/

    public function aboutus(){
        return view();
    }
}