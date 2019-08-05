<?php
namespace app\wap\controller;
use think\Cache;
use app\common\model\User as userModel;
class index extends Base {

    public function _initialize(){
        parent::_initialize(); // TODO: Change the autogenerated stub
    }


    /*  首页列表数据
     *  @param  分类列表
     *  @param  热门专题
     *  @return array
     *  */
    public function index(){
        return view();
    }

    /*  获取用户的openid */
    public function get_openid(){
        $user_IP = empty($_SERVER["HTTP_VIA"]) ? $_SERVER["REMOTE_ADDR"] : $_SERVER["HTTP_X_FORWARDED_FOR"] ;//userIp
        $agent = strtolower($_SERVER['HTTP_USER_AGENT']);//客户端
        $key = md5('jmzn'.$agent.$user_IP);
        $openid = Cache::get($key);
        //验证openid
        if(empty($openid)){
            $username = '游客';
        }else{
            $userModel = new userModel();
            $username = $userModel -> getUserField(['wx_openid'=>$openid],'uname');
        }
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data']['openid'] = $openid;
        $rinfo['data']['username'] = $username;
        wapReturn($rinfo);
    }
    /*  首页列表数据
     *  @param  分类列表
     *  @param  热门专题
     *  @return array
     *  */
    public function index_list(){
        //定义参数
        $returnCode = config('RETURNLOG');
        $cateModel  = model('category');
        $groupModel = Model('group');
        //分类数据
        $whereCate['status'] = 1;
        $whereCate['pid'] = 0;
        $result['cate'] = $cateModel -> getCate($whereCate);
        $whereGroup['type'] = 1;
        $whereGroup['status'] = 1;
        $result['group'] = $groupModel -> getGroup($whereGroup);
        $data = $returnCode['SUCCESS'][0];
        $data['data'] = $result;
        wapReturn($data);
    }

    /*  首頁  文章與專題列表
     *  @param  热门推荐    加盟项目(专题)
     *  @param  行业报告
     * */
    public function item_list(){
        $itemModel  = model('item');
        $articleModel = Model('article');
        $whereItem['status'] = 1;
        $whereItem['reco_wap'] = 0;
        //正常分页
        $page = empty($_REQUEST['page']) ? 0 : $_REQUEST['page'] - 1;
        $num = empty($_REQUEST['num']) ? 7 : $_REQUEST['num'];
        $limit = $page * $num . ' , ' . $num ;

        $result['item'] = $itemModel -> getItem($whereItem,$limit);
        $whereArticle['status'] = 1;
        $whereArticle['type'] = 0;
        $n = $_REQUEST['page'] - 1 ;
        $aPage = $n*1;
        $aLimit = $aPage.' ,1';
        $result['article'] = $articleModel -> getArticleData($whereArticle,$aLimit);
        $data['code'] = 200;
        $data['msg'] = '成功';
        $data['data'] = $result;
        wapReturn($data);

    }

    /*搜索、专题列表
     *  搜索[分类、关键词、投资金额、]
     *  个人搜藏    首页专题（专题组）
     *  所有项目列表
     *  */
    public function data_list(){
        //实例化模型
        $itemModel = model('item');
        //接收 && 验证参数
        //我的收藏
        $type = empty($_REQUEST['type']) ? 0 : $_REQUEST['type'];
        if($type !=0){
            if(empty($_REQUEST['token'])){
                $RETURN_LOG = config('RETURNLOG');
                wapReturn($RETURN_LOG['ERROR'][5]);
            }
                $token = $_REQUEST['token'];
                $user = Cache::get($token);
            if($type ==1 ){//我的收藏/验证登录 || 我的足迹
                //获取收藏的项目id
                $fWhere['uid'] = $user['uid'];
                $fWhere['ftype'] = 2;
                $fWhere['status'] = 1;
                $follModel = model('follow');
                $itemIdString = $follModel -> getTid($fWhere);
                $where['id'] = array('in',$itemIdString);

                //改变消息通知状态为已读start
                $noticeData['uid'] = $user['uid'];
                $noticeData['type'] = 5;
                $this -> model('notice') -> read_notice($noticeData);
                //改变消息通知状态为已读end

            }elseif($type == 2){
            //验证是否是足迹列表
                $logWhere['uid'] = $user['uid'];
                $logWhere['status'] = 1;
                //获取访问过的项目id
                $trackModel = model('track');
                $idStr = $trackModel -> getMyTrackTid($logWhere);
                $where['id'] = array('in',$idStr);
            }
        }
        //搜索-项目列表 ： 投资金额检索
        $mKey = empty($_REQUEST['money']) ? 0 : $_REQUEST['money'];
        if($mKey != 0){
            $mConf = config('MONEY');
            $where['min_money'] = array('egt',$mConf[$mKey]['min']);
            $where['max_money'] = array('elt',$mConf[$mKey]['max']);
        }
        //分类检索
        $cId = empty($_REQUEST['cate_id']) ? 0 : $_REQUEST['cate_id'];
        if($cId !=  0){
            //验证是顶级分类还是二级分类
           $cateModel = model('category');
           $cateWhere['id'] = $cId;
           $cateData = db('category') -> where($cateWhere) -> find();
           if($cateData['pid'] == 0){//顶级分类
               $idStr = $cId.',';
               $cWhere['pid'] = $cId;
               $cWhere['status'] = 1;
               $idStr .= $cateModel -> getChildIdByWhere($cWhere);
               $where['cate_id'] = array('in',rtrim($idStr,','));
           }else{//二级分类
               $where['cate_id'] = $cId;
           }
        }
        //关键字
        $keyword = empty($_REQUEST['keyword']) ? '' : $_REQUEST['keyword'];
        if(!empty($keyword)){
            $where['item_name'] = array('like', '%' . $keyword . '%');
            //存储到搜索历史  验证登录 登录才存储搜索历史
            $token = empty($_REQUEST['token']) ? '' : $_REQUEST['token'];
            $user = Cache::get($token);
            //用户信息不为null 将搜索数据存储起来
            if(!empty($user)){
                $addSearchData['uid'] = $user['uid'];
                $addSearchData['word'] = $keyword;
                $addSearchData['type'] = 0;
                $addSearchData['addtime'] = time();
                $addSearchData['status'] = 1;
                $res = db('search_log') -> insertGetId($addSearchData);
            }
        }
        //通过专题组（热门专题）
        $groupId = empty($_REQUEST['group_id']) ? '' : $_REQUEST['group_id'];
        if(!empty($groupId)){
            $groupWhere['gid'] = $groupId;
            $groupSub = db('group_sub') -> where($groupWhere) -> select();
            $itemIdStr = '';
            foreach ($groupSub as $key => $value) {
                $itemIdStr .= $value['tid'].',';
            }
            $itemIdStr = trim($itemIdStr,',');
            $where['id'] = array('in',$itemIdStr);
        }
        $where['status'] = 1;
		//获取项目数据
        //分页设置
        $page = $_REQUEST['page'] - 1 ;
        $num = $page * 7;
        $limit = $num.',7';
        $data = $itemModel -> getItem($where,$limit);
        $jsonData['code'] = 200;
        $jsonData['msg'] = '成功';
        $jsonData['data'] = $data;
//        $jsonData['debug']['debug'] = $data['debug'];
        wapReturn($jsonData);

    }

    /*区域二级联动*/
    public function area(){
        $city = db('city');
        $where['pid'] = empty($_REQUEST['pid']) ? 0 : $_REQUEST['pid'];
        $cityData = $city -> where($where) -> select();
        if($cityData){
            $data['code'] = 200;
            $data['msg'] = '成功';
            $data['data'] = $cityData;
        }else{
            $data['code'] = 400;
            $data['msg'] = '失败';
        }
        return json_encode($data);
    }

    /*  广告接口    */
    public function get_ad(){
        //接收参数
        $returnCode = config('RETURNLOG');
        $wp = empty($_REQUEST['wp']) ? wapReturn($returnCode['ERROR'][1]) : $_REQUEST['wp'];
        $p = empty($_REQUEST['p']) ? 0 : $_REQUEST['p'];

        //定义查询条件
        $imageModel = db('image');
        $where['client'] = 2;//wap端广告
        $where['web_page'] = $wp;//所展示页面
        $where['position'] = $p;//所展示位置
        $where['status'] = 1;//有效

        if((string)$p == 'all'){
         //验证所请求页面
            switch ($wp) {
                case 1://首页
                    $position = [['id'=>1,'name'=>'A区域']];
                    break;
                case 4://热门专题
                    $position = db('group') -> where(['status'=>1]) -> order('id asc') ->field('id,name') -> select();
                    break;

                default:
                    $position = db('category') -> where(['status'=> 1,'pid'=>0]) -> order('id asc') -> field('id,name') -> select();
                    break;
            }
            //遍历查询出所有的广告
            foreach ($position as $key => $value) {
                $where['position'] = $value['id'];
                $ad = $imageModel -> where($where) -> select();
                $dataList[] = $this -> formatImageDataList($ad);
            }
            $rinfo = $this -> returnCode['SUCCESS'][0];
            $rinfo['data'] = $dataList;
            wapReturn($rinfo);
        }
        //默认广告
        if((string)$p == 'defult'){
            $where['position'] = 999;
        }
        //执行查询
        $dataList = $imageModel -> where($where) -> order('position desc , id desc') -> select();
        if(empty($dataList)){//数据不存在
            $rinfo = $this -> returnCode['SUCCESS'][0];
            $rinfo['data'] = [];
            wapReturn($rinfo);
        }
        $rdata = $this -> formatImageDataList($dataList);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $rdata;
        wapReturn($rinfo);
    }

    /*  格式化广告参数 */
    public function formatImageDataList($data = false ,$type = false ){
        if(empty($data)){   return [];  }
        $link = config('LINK')['WAP'];
        $image = config('IMAGE');
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['title'] = $value['title'];
            $dataList[$key]['sign'] = $value['sign'];
            $dataList[$key]['type'] = $value['type'];
            switch ($value['type']) {
                case 1://外链
                    $dataList[$key]['link'] = empty($value['link']) ? 'javascript:;' : $value['link'];
                    break;
                case 2://链接到项目
                    $dataList[$key]['link'] = empty($value['link']) ? '' : $link['ITEM'].trim($value['link']);
                    break;
                case 3://链接到文章
                    $dataList[$key]['link'] = empty($value['link']) ? '' :  $link['ARTICLE'].trim($value['link']);
                    break;
                default://外链
                    $dataList[$key]['link'] = $value['link'];
                    break;
            }
            $dataList[$key]['img'] = $image['PERFIX'].$value['img'];
        }
        return $dataList;
    }
}
