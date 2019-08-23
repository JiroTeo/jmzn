<?php
namespace app\index\controller;
use think\Cache;
use app\index\model\Item as itemModel;
use app\index\model\Category as cateModel;
use app\index\model\Article as artModel;
use app\index\model\Consult as consultModel;
class item extends Base{

    private $itemModel;

    public function _initialize(){
        parent::_initialize();
        // 实例化y用户模型
        $this->itemModel = new itemModel();
    }

    /*  找项目【项目列表】   todo
     *  【行业分类】
     *  【投资金额】
     * **/
    public function index(){
        $cateModel = new cateModel();
        $itemModel = new itemModel();
        $artModel = new artModel();

        //接收 && 定义参数
        $cateChild = false;
        $pid = $this -> request -> param('pid');
        $cid = $this -> request -> param('cid');
        $mKey = $this -> request -> param('mkey');

        $sort = $this -> request -> param('sort');
        //获取行业分类
        $cateData = $cateModel -> getCateDataList(['status'=>1,'pid'=>0],'id asc',false ,2);
        //获取子级别行业分类
        if(!empty($pid)){
            //子集分类
            $cateChild = $cateModel -> getCateChildList(['status'=>1,'pid'=>$pid]);
            //子集分类id没有传递的时候 查询出父级分类下所有的项目
            if(empty($cid)){
                $cateIds = $pid.',';
                $cateIds .= $cateModel -> getChildIdByWhere(['pid'=>$pid,'status'=>1]);
                $where['cate_id'] = array('in',$cateIds);
            }
        }
        //根据子集分类获取项目列表
        if(!empty($cid)){
            $where['cate_id'] = $cid;
        }
        //金额
        if(!empty($mKey)){
            $moeney = config('MONEY');
            $where['min_money'] = array('egt',$moeney[$mKey]['min']);
            $where['max_money'] = array('elt',$moeney[$mKey]['max']);
        }
        //关键字
        //关键字检索项目
        $keyword = empty($_REQUEST['keyword']) ? false : $_REQUEST['keyword'];
        if(!empty($keyword)){
            $where['item_name'] = array('like', '%' . trim($keyword) . '%');
            //验证登录——埋点——添加到搜索记录
            if(!empty($this -> user)){
                $addSearchData['uid'] = $this -> user['uid'];
                $addSearchData['word'] = $keyword;
                $addSearchData['type'] = 0;
                $addSearchData['addtime'] = time();
                $addSearchData['status'] = 1;
                db('search_log') -> insertGetId($addSearchData);
            }
        }
        //项目列表
        $where['status'] = 1;
        $order = empty($sort) ? 'id desc' : 'read_num desc' ;
        $page = '';
        $itemData =$itemModel -> getItemDataListPage($where,$order,10,4,$page);
        //项目排行榜
        $ranking = $itemModel -> getItemDataList(['status'=>1],'read_num desc',13,1);
        //行业资讯
        $artData['rArticle'] = $artModel -> getArticleDataForReco(['status'=>1,'reco'=>1]);
        $artwhere['status'] = 1;
        $artwhere['id'] = ['neq',$artData['rArticle']['id']];
        $artData['aticle'] = $artModel -> getArticleData($artwhere,'addtime desc',7,2);
        //处理跳转链接
        $mKeyUrl = '';
        if($mKey){
            $mKeyUrl = '&mkey='.$mKey;
        }
        $cidUrl = '';
        if($pid && $cid){
            $cidUrl = '?pid='.$pid.'&cid='.$cid.'&';
        }else if(empty($cid)){
            $cidUrl = '?pid='.$pid.'&';
        }else{
            $cidUrl = '?';
        }
        //分配变量
        $this -> assign('cateData',$cateData);//顶级行业分类
        $this -> assign('cateChild',$cateChild);//子级行业分类
        $this -> assign('itemData',$itemData);//项目列表
        $this -> assign('ranking',$ranking);//项目排行
        $this -> assign('artData',$artData);//行业资讯
        $this -> assign('page',$page);//分页
        $this -> assign('mkeyUrl',$mKeyUrl);
        $this -> assign('sort',(int)$sort);
        $this -> assign('cidUrl',$cidUrl);
        $this -> assign('pid',empty($pid)? 0 : $pid);//顶级分类id
        $this -> assign('cid',empty($cid)? 0 : $cid);//二级分类id
        $this -> assign('mkey',empty($mKey)? 0 : $mKey);//金额mkey
        $this -> assign('title','找项目');
        return view();
    }

    /*  项目详情  todo  */
    public function detail(){
        $itemModel = new itemModel();
        $artModel = new artModel();
        $consultModel = new consultModel();
        $page = '';
        $id = $this -> request -> param('id');
        //足迹
        $uid = empty($_SESSION['jmzn_web']['uid']) ? 0 : $_SESSION['jmzn_web']['uid'];
        if(!empty($uid)){
            $trackWhere['tid'] = $id;
            $trackWhere['uid'] = $uid;
            $trackWhere['type'] = 1;
            $trackModel = model('track');
            $trackModel -> addTrack($trackWhere);
        }
        //浏览次数
        $itemModel -> where('id',$id) -> setInc('read_num',1);
        //内容
        $data = $itemModel -> getItemData(['status'=>1,'id'=>$id],1);//项目详情
        //加盟项目排行榜
        $ranking = $itemModel -> getItemDataList(['status'=>1],'read_num desc',13,1);
        //行业资讯
        $artData['rArticle'] = $artModel -> getArticleDataForReco(['status'=>1,'reco'=>1]);
        $artwhere['status'] = 1;
        $artwhere['id'] = ['neq',$artData['rArticle']['id']];
        $artData['list'] = $artModel -> getArticleData($artwhere,'addtime desc',7,2);
        
        //留言
        $consult = $consultModel -> getConsultListByPage(['item_id'=>$id,'status'=>1],'id desc',5,1,$page);

        //分配变量
        $this -> assign('data',$data['item']);//项目信息
        $this -> assign('user',$data['user']);//用户信息
        $this -> assign('ranking',$ranking);//加盟项目排行榜
        $this -> assign('artData',$artData);//行业资讯
        $this -> assign('consult',$consult);//留言数据
        $this -> assign('page',$page);//分页
        return view();
    }

    /*  加盟项目排行榜     todo */
    public function itemRankList(){
        $where['status'] = 1;
        $data = $this -> itemModel -> getItemDataList($where,'read_num desc','13',1);
        $this -> assign('data',$data);
        dump($data);
    }


    /*  清空足迹   */
    public function del_item_log(){
        $returnCode =  config('RETURNLOG');
        $trackModel = model('track');
        //验证token
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'] ;
        //验证用户信息
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //获取&&定义参数 执行删除操作
        $where['uid'] = $user['uid'];
        $where['type'] = 1;
        $where['status'] = 1;
        $result = $trackModel -> clearTrackLog($where);
        if($result){
            $dataList = $returnCode['SUCCESS'][0];
        }else{
            $dataList = $returnCode['ERROR'][0];
        }
        wapReturn($dataList);
    }

    /*  我的留言    */
    public function get_consult_item(){
        $returnCode = config('RETURNLOG');
        //验证token
        $token = empty($_REQUEST['token']) ? false : $_REQUEST['token'] ;
        if(empty($token)){
            wapReturn($returnCode['ERROR'][1]);
        }
//        验证登录
        $user = Cache::get($token);
        if(empty($user)){
            wapReturn($returnCode['ERROR'][5]);
        }
        //接收 && 定义参数
        $consultModel = model('consult');
        //获取留言数据&& 通过数据查找项目
        $where['uid'] = $user['uid'];
        $where['type'] = 0;
        $itemData = $consultModel -> get_item_data($where);
        if(empty($itemData)){//数据不存在
            $dataList = $returnCode['ERROR'][4];
            $dataList['data'] = array();
        }else{
            $dataList = $returnCode['SUCCESS'][0];
            $dataList['data'] = $itemData;
        }
        wapReturn($dataList);
    }

    /*  热门排行    */
    public function hot_item_list(){
        //定义条件
        $where['status'] = 1;
        $data = $this -> itemModel -> getItemDataList($where,'read_num desc','13',1);
        if(empty($data)){
            $rinfo = $this->returnCode['ERROR'][4];
            $rinfo['data'] = array();
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
            $rinfo['data'] = $data;
        }
        wapReturn($rinfo);
    }

    /*  品牌精选    */
    public function get_brand_item_list(){
        $debug = empty($_REQUEST['debug']) ? 0 : $_REQUEST['debug'] ;
        //定义条件  查询出所关联的项目id
        $gid = config('CHOICE');
        $where['gid'] = config('CHOICE');
        $where['status'] = 1;
        $where['reco_img'] = 1;
        $imgIdStr = model('group') -> getItemIdStr($where,'addtime desc',5);
        unset($where['reco_img']);
        $where['reco_brand'] = 1;
        $brandIdStr = model('group') -> getItemIdStr($where,'addtime desc',7);
        //查询出内容
        $itemWhere['id'] = array('in',$brandIdStr);
        $itemWhere['status'] = 1;
        $data['brand'] = $this -> itemModel -> getItemDataList($itemWhere,'id desc','',1);
        $itemWhere['id'] = array('in',$imgIdStr);
        $data['image'] = $this -> itemModel -> getItemDataList($itemWhere,'id desc','',2);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }

    /*  项目推荐*/
    public function get_reco_item_list(){
        $num = empty($_REQUEST['num']) ? 12 : $_REQUEST['num'] ;
        //定义参数 && 查询数据
        $where['status'] = 1;
        $where['reco'] = 1;
        $data = $this -> itemModel -> getItemDataList($where,'addtime desc',$num,3);
        if(empty($data)){
            $rinfo = $this -> returnCode['ERROR'][1];
            $data = array();
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }

    /*  项目详情    */
    public function item_detail(){
        //两种途径进入项目详情1通过id访问2个人中心访问我的品牌页面    接收参数 token&&id
        $id = empty($_REQUEST['id']) ? false : $_REQUEST['id'];
        if(empty($id)){
            //个人中心访问品牌页面
            if(empty($this -> user)){//验证登录
                $rinfo = $this -> returnCode['ERROR'][5];
                wapReturn($rinfo);
            }
            //查询出项目id
            $where['wid'] = $this -> user['uid'];
            //获取到项目id
            $id = $this -> itemModel -> where($where) -> value('id');
        }
        //足迹节点
        if(isset($this -> user['uid'])){
            $trackWhere['tid'] = $id;
            $trackWhere['uid'] = $this -> user['uid'];
            $trackWhere['type'] = 1;
            $trackModel = model('track');
            $trackModel -> addTrack($trackWhere);
        }
        //浏览量+1 节点
        $itemWhere['id'] = $id;
        $this -> itemModel -> where($itemWhere) -> setInc('read_num',1);
        // 项目数据
        $itemWhere['status'] = 1;
        $data = $this -> itemModel -> getItemData($itemWhere,1,$this -> user);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }

    /*  项目列表    */
    public function item_list(){
        $debug = empty($_REQUEST['debug']) ? false : $_REQUEST['debug'];
        //接收参数 && 定义参数 && 查询数据
        $format = 4;//数据格式化方式 4为项目列表格式
        $type = empty($_REQUEST['type']) ? 0 : $_REQUEST['type'];//区分是否为收藏||足迹||留言
        $order = empty($_REQUEST['order']) ? 'addtime desc' : 'read_num desc' ;//排序规则
        $num = empty($_REQUEST['num']) ? 10 : $_REQUEST['num'];
        $page = empty($_REQUEST['page']) ? 0 : $_REQUEST['page'];//分页
        $limit = $page * $num . ' , ' . $num;

        //是否为收藏-关注-足迹-我的留言
        if(!empty($type)){
            if(empty($this -> user)){//未登录
                $rinfo = $this -> returnCode['ERROR'][5];
                wapReturn($rinfo);
            }
            if($type == 1){//收藏
                $fWhere['uid'] = $this -> user['uid'];
                $fWhere['ftype'] = 2;
                $fWhere['status'] = 1;
                $follModel = model('follow');
                $itemIdString = $follModel -> getTid($fWhere);
                $where['id'] = array('in',$itemIdString);
                //——埋点——改变消息通知状态为已读start
                $noticeData['uid'] = $this -> user['uid'];
                $noticeData['type'] = 5;
                model('notice') -> read_notice($noticeData);
                //——埋点——改变消息通知状态为已读end
            }
            if($type == 2){//关注
                $fWhere['uid'] = $this -> user['uid'];
                $fWhere['ftype'] = 1;
                $fWhere['status'] = 1;
                $follModel = model('follow');
                $concernIds = $follModel -> getTid($fWhere);
                $where['id'] = array('in',$concernIds);
            }
            if($type == 3){//足迹
                $logWhere['uid'] = $this -> user['uid'];
                $logWhere['status'] = 1;
                //获取访问过的项目id
                $trackModel = model('track');
                $idStr = $trackModel -> getMyTrackTid($logWhere);
                $where['id'] = array('in',$idStr);
            }
        }
        //分类检索数据
        $cId = empty($_REQUEST['cate_id']) ? false : $_REQUEST['cate_id'];
        if(!empty($cId)){
            //验证是顶级分类还是二级分类
           $cateModel = model('category');
           $cateWhere['id'] = $cId;
           $cateData = db('category') -> where($cateWhere) -> find();
           if($cateData['pid'] == 0){//顶级分类
               $idStr = $cId . ',';
               //查询出子类id
               $catewhere['pid'] = $cId;
               $catewhere['status'] = 1;
               $idStr .= $cateModel -> getChildIdByWhere($catewhere);
               $where['cate_id'] = array('in',$idStr);
           }else{//二级分类
               $where['cate_id'] = $cId;
           }
        }
        //投资金额检索项目
        $mKey = empty($_REQUEST['money']) ? 0 : $_REQUEST['money'];
        if($mKey != 0){
            $mConf = config('MONEY');
            $where['min_money'] = array('egt',$mConf[$mKey]['min']);
            $where['max_money'] = array('elt',$mConf[$mKey]['max']);
        }
        //关键字检索项目
        $keyword = empty($_REQUEST['keyword']) ? false : $_REQUEST['keyword'];
        if(!empty($keyword)){
            $where['item_name'] = array('like', '%' . $keyword . '%');
            //验证登录——埋点——添加到搜索记录
            if(!empty($this -> user)){
                $addSearchData['uid'] = $this -> user['uid'];
                $addSearchData['word'] = $keyword;
                $addSearchData['type'] = 0;
                $addSearchData['addtime'] = time();
                $addSearchData['status'] = 1;
                db('search_log') -> insertGetId($addSearchData);
            }
        }
        //  执行查询 && 格式化列表数据
        $where['status'] = 1;
        $dataList['data'] = $this -> itemModel -> getItemDataList( $where , $order , $limit , $format , $this -> user , $debug );//where/order/limit/type/user/debug
        $dataList['count'] = $this -> itemModel -> itemCount($where);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $dataList;
        wapReturn($rinfo);
    }

    /*  排行榜-推荐品牌-综合品牌-排行榜 */
    public function reco_brand_list(){
        //获取推荐品牌排行榜数据START
        $where['reco_brand'] = 1;
        $where['status'] = 1;
        $data['reco_brand'] = $this -> itemModel -> getItemDataList($where,'order desc,addtime desc',10,1);//where order limit type user debug
        //获取推荐品牌排行榜数据END
        //获取综合品牌排行榜START
        $data['brand'] = $this -> itemModel -> getItemDataList(['status'=>1],'read_num desc',10,1);//where order limit type user debug
        //获取综合品牌排行榜END
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }

    /*  精选推荐    */
    public function selected_reco(){
        $data = $this -> itemModel -> getItemDataList('','read_num desc',10,1);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }


}