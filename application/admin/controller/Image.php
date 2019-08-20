<?php
namespace app\admin\controller;
use think\Db;
use think\Controller;
use think\View;

class image extends Base{

    // 构造方法
    public function __construct(){
        parent::__construct();
        $this -> imageModel = db('image');
    }

    /*  @param      广告列表
     *  @param      添加广告
     *  @param      删除广告
     *  @param      修改
     * **/
    /*广告列表*/
    public function image_list(){
        $data = input('get.');
        if(!empty($data)){
//            $where = $data;
//            unset($where['page']);
        }
        $where['status'] = 1;
        $objData = $this -> imageModel -> where($where) -> order('addtime desc') -> paginate(30);
        $page = $objData -> render();
        $data = iterator_to_array($objData);
        $opeion = config('ADPOS');
        foreach ($data as $key => $value) {
            //perfix
            $perfix = ($value['client'] == 1) ? 'WEB' : 'WAP' ;
            $data[$key]['tag'] = $perfix;
            $data[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
            //type
            $data[$key]['type'] = (empty($value['type']))
                ?   "<spen style='font-size: 21px;color:#880000;font-weight: bold'>未定义</spen>"
                :   $data[$key]['type'] = $opeion['TYPE'][$value['type']];
//            web_page
            $wp = $value['web_page'];
            $data[$key]['web_page'] = empty($wp)
                ?   "<spen style='font-size: 21px;color:#880000;font-weight: bold'>未定义</spen>"
                : $opeion[$perfix]['PAGE'][$wp];
            //position
            if($perfix == 'WEB'){
            $data[$key]['position'] = empty($value['position'])
                ?   "<spen style='font-size: 21px;color:#880000;font-weight: bold'>未定义</spen>"
                :   $opeion[$perfix]['POSITION'][$value['position']];
            }
        }
        $getStr = empty($_SERVER["QUERY_STRING"]) ? '?' : '?'.$_SERVER["QUERY_STRING"].'&';//拼接参数前置
        $this -> assign('getstr',$getStr);//参数
        $this -> assign('image',config('ADPOS'));
        $this -> assign('data',$data);
        $this -> assign('page',$page);
        return view();
    }

    /*新增广告*/
    public function add_image(){
        if($_POST){
            $adpos = config('ADPOS');
            $data = input('post.');
            //定义参数&&进行拼接
            $position = input('post.position');
            $web_page = input('post.web_page');
            $perfix = ($data['client'] == 1) ? 'WEB' : 'WAP' ;

            if($perfix == 'WAP' && $data['web_page'] != 1){
                if($data['web_page'] == 4){//项目组
                    $pos = db('group') -> where(['id'=>$position]) -> value('name');
                    $data['remarks'] = "WAP->热门专题->".$pos;
                }else if($data['web_page'] == 5){//资讯
                    switch ($position) {
                        case 1:
                            $pos = '加盟资讯';
                            break;
                        case 2:
                            $pos = '加盟攻略';
                            break;
                        default:
                            $pos = '行业报告';
                            break;
                    }
                    $data['remarks'] = "WAP->资讯列表->".$pos;
                }else{//搜索或者行业分类
                    $pos = db('category') -> where(['id'=>$position]) -> value('name');
                    $data['remarks'] = $perfix.'->'.$adpos[$perfix]['PAGE'][$web_page].'->'.$pos;
                }
            }else{
                $data['remarks'] = $perfix.'->'.$adpos[$perfix]['PAGE'][$web_page].'->'.$adpos[$perfix]['POSITION'][$position];
            }

            //验证时web端还是wap端的广告
            $data['addtime'] = time();
            $data['type'] = empty($data['type']) ? 2 : $data['type'];
            $res = $this -> imageModel -> insertGetId($data);
            if($res){
                $this -> success('SUCCESS');
            }else{
                $this -> error('LOSE');
            }
        }else{

            $ad = config('ADPOS');
            unset($ad['WEB']['POSITION'][888]);
            unset($ad['WEB']['POSITION'][999]);
            unset($ad['WAP']['POSITION'][999]);
            unset($ad['WAP']['POSITION'][999]);
            $this -> assign('ad',$ad);
            return view();
        }
    }

    /*修改广告*/
    public function edit_image_data(){
        if($_POST){
            $data = input('post.');
            $where['id'] = $data['id'];
            unset($data['id']);//删掉id避免ERROR
            $reuslt = $this -> imageModel -> where($where) -> update($data);
            if($reuslt){
                $this -> success('SUCCESS');
            }else{
                $this -> error('LOSE');
            }
        }else{
            $where['id'] = $_GET['id'];
            $data = $this -> imageModel -> where($where) -> find();
            $data['perfix'] = ($data['client'] == 1) ? 'WEB' : 'WAP' ;
            $adpos = config('ADPOS');
            $this -> assign('adpos',$adpos);
            $this -> assign('data',$data);
            return view();
        }
    }

    /*删除广告*/
    public function del_image(){
        $where['id'] = $_POST['id'];
        $save['status'] = 0;
        $result = $this -> imageModel -> where($where) -> update($save);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

    /*  js获取广告配置  */
    public function getconfaspos(){
//        $postData = input('post.');
        $postData = $_REQUEST;
        $adpos = config('ADPOS');
        if($postData['type'] == 1){
            $f = $postData['f'];
            $web = $adpos[$f];
            $data['p'] = $web['PAGE'];
            $data['t'] = $web['POSITION'];
        }else{
            switch ($postData['pos']) {
                case 1://首页
                    $data = [1=>'A区域',999=>'默认广告'];
                    break;
                case 2://行业分类
                    $data = model('category') -> getJsCateData(['pid'=>0,'status'=>1]);
                    break;
                case 3://搜索
                    $data = model('category') -> getJsCateData(['pid'=>0,'status'=>1]);
                    break;
                case 4://项目组
                    $data = model('group') -> getJsGroupData(['status'=>1]);
                    break;
                case 5://文章列表
                    $data = [1=>'行业报告',2=>'加盟资讯',3=>'加盟攻略',999=>'默认广告'];
                    break;
                default:
                    # code...
                    break;
            }
        }
        wapReturn($data);
    }

    /*  js  接口  */
    public function getwpandpos(){
        $data = input('post.');
        $adpos = config('ADPOS');
        $ad['wp'] = $adpos[$data['f']]['PAGE'];//所属页面
        if($data['f'] != 'WEB' && $data['p'] != 1){
            switch ($data['wp']) {
                case 2://行业分类
                    $ad['p'] = model('category') -> getJsCateData(['pid'=>0,'status'=>1]);
                    break;
                case 3://搜索
                    $ad['p'] = model('category') -> getJsCateData(['pid'=>0,'status'=>1]);
                    break;
                case 4://项目组
                    $ad['p'] = model('group') -> getJsGroupData(['status'=>1]);
                    break;
                case 5://文章列表
                    $ad['p'] = [1=>'行业报告',2=>'加盟资讯',3=>'加盟攻略'];
                    break;
                default:
                    $ad['p'] = $adpos[$data['f']]['POSITION'];
                    break;
            }
        }else{
            $ad['p'] = $adpos[$data['f']]['POSITION'];
        }
        wapReturn($ad);
    }
}