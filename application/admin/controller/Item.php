<?php
namespace app\admin\controller;

class item extends Base{

    // 构造方法
    public function __construct(){
        parent::__construct();
        // 实例化分类模型
        $this->itemModel = model('item');
        $this->cateModel = model('category');
    }

    /*  @param  项目列表index
     *  @param  发布项目
     *  @param  添加项目内容-富文本
     *  @param  项目详情-修改项目
     *  @param  删除项目
     *  @param  查看留言
     *  @param  今日留言项目
     *  @param  设置为推荐&&取消推荐
     *  @param  项目排序
     * **/

    /*项目列表*/
    public function index(){
        //檢索內容
        $data = input('post.');
        $get = input('get.');
        $res = empty($data);
        if(empty($res)){
            $start = empty($data['start']) ? 1554949251 : strtotime($data['start']) ;
            $end = empty($data['end']) ? time() : strtotime($data['end']. '23:59:59') ;
            $where['addtime'] = [['egt',$start],['elt',$end],'and'];
            if(!empty($data['keyword'])){
                $whereOr['id'] = ['like',"%".$data['keyword']."%"];
                $whereOr['wid'] = ['like',"%".base64_encode($data['keyword'])."%"];
                $whereOr['item_name'] = ['like',"%".$data['keyword']."%"];
                $whereOr['recommend'] = ['like',"%".$data['keyword']."%"];
                $whereOr['brand'] = ['like',"%".$data['keyword']."%"];
                $whereOr['company'] = ['like',"%".$data['keyword']."%"];
            }
        }
        if(!empty($get)){//查看推荐
            unset($get['page']);
            unset($get['/admin/item/index_html']);
            $where = $get;
        }
        $whereOr = empty($whereOr)? false : $whereOr;
        $where['status'] = 1;
        $dataList = $this -> itemModel -> getItemData($where,$whereOr);
        $this -> assign('page',$dataList['page']);
        $this -> assign('data',$dataList['data']);
        $this -> assign('get',$_GET);
        return View();
    }

    /*分组内的项目*/
    public function group_item_list(){
        $group_id = $_GET['id'];
        $subWhere['gid'] = $group_id;
        $subWhere['status'] = 1;
        $groupSubData = db('group_sub') -> where($subWhere) -> select();
        //
        $where = [];
        $dataList = [];
        foreach ($groupSubData as $key => $value) {
            $where['id'] = $value['tid'];
            $dataList[$key] = $this -> itemModel -> getItem($where);
            if($dataList){
                $dataList[$key]['reco_brand'] = $value['reco_brand'];
                $dataList[$key]['reco_img'] = $value['reco_img'];
            }
        }
        $this -> assign('data',$dataList);
        $this -> assign('gid',$group_id);
        return View();
    }

    /*发布项目*/
    public function add_item(){
        if($_POST){//添加数据
            $data = input('post.');
            $cate_id = empty($data['cate_id']) ? $data['cate_pid'] : $data['cate_id'];
            $item_area = empty($data['city']) ? $data['province'] : $data['city'];
            unset($data['province']);
            unset($data['city']);
            $data['item_area'] = $item_area;
            $data['cate_id'] = $cate_id;
            $data['addtime'] = time();
            //是否上传了图片
            $data['brand_make_time'] = strtotime($_POST['brand_make_time']);
            if(!empty($data['image'])){
                $data['image'] = implode(',',$data['image']);
            }
            $res = db('item') -> insertGetId($data);
            //发布成功  将用户和分类关联起来
            if(!empty($data['wid']) && !empty($cate_id)){
                //查询用户与分类是否存在
                $userCateDB = db('user_cate');
                $userCateRes = $userCateDB -> where(['uid'=>$data['wid'],'cate_id'=>$cate_id]) -> count();
                if(empty($userCateRes)) {//不存在执行添加
                    $addUserCateData['uid'] = $data['wid'];
                    $addUserCateData['cate_id'] = $cate_id;
                    $addUserCateData['type'] = 1;
                    $addUserCateData['status'] = 1;
                    $result = $userCateDB -> insertGetId($addUserCateData);
                }
            }
            //关联END
            if($res){
                $this -> success('添加成功');
            }else{
                $this -> error('添加失败');
            }
        }else{
            //用户列表
            $userData = db('user') -> where(['type'=>1]) -> order('rtime desc') -> select();
            foreach ($userData as $key => $value) {
                $data[$key]['uid'] = $value['uid'];
                $data[$key]['cname'] = $value['cname'];
                $data[$key]['name'] = $value['name'];
                $data[$key]['bname'] = $value['bname'];
                $data[$key]['username'] = empty($value['uname']) ? '' : base64_decode($value['uname']);
            }
            $this -> assign('data',$data);
            return View();
        }
    }

    /*项目富文本*/
    public function add_text(){
        if($_POST){
            switch ($_POST['type']) {
                case 1://加盟优势
                    $data['adv'] = $_POST['text'];
                    break;
                case 2://加盟攻略
                    $data['path'] = $_POST['text'];
                    break;
                case 3://加盟费用
                    $data['cost'] = $_POST['text'];
                    break;
                default:
                    $data['detail'] = $_POST['text'];
                    break;
            }
            $where['id'] = $_POST['id'];
            $res = $this -> itemModel -> editData($where,$data);
            if($res){
                    $this -> success('SUCCESS');
            }else{
                $this -> error('ERROR');
            }
        }else{
            $data['type'] = $_GET['type'];
            $data['id'] = $_GET['id'];
            //查询出数据
            switch ($_GET['type']) {
                case 1://加盟优势
                    $value = 'adv';
                    break;
                case 2://加盟攻略
                    $value = 'path';
                    break;
                case 3://加盟费用
                    $value = 'cost';
                    break;
                default:
                    $value = 'detail';
                    break;
            }
            $where['id'] = $data['id'];
            $data['detail'] = db('item') -> where($where) -> value($value);
            $this -> assign('data',$data);
            return view();
        }
    }

    /*详情页面/修改页面*/
    public function item_detail(){
        if($_POST){
            $data = input('post.');
            $data['cate_pid'] = empty($data['cate_pid']) ? 2 : $data['cate_pid'];
            $data['cate_id'] = empty($data['cate_id']) ? $data['cate_pid'] : $data['cate_id'];
            $data['item_area'] = empty($data['city']) ? $data['province'] : $data['city'];
            //删除省份与城市
            unset($data['province']);
            unset($data['city']);
            $where['id'] = $data['id'];
            unset($data['id']);
            $res = $this -> itemModel -> editData($where,$data);
            if($res){
                $this -> success('修改成功');
            }else{
                $this -> error('修改失败');
            }
        }else{
            $where['id'] = $_GET['id'];
            $itemata = $this -> itemModel -> itemDetail($where);
            $itemata['brand_make_time'] = date("Y-m-d",$itemata['brand_make_time']);
            $itemata['image'] = explode(',',trim($itemata['image'],','));
            //获取地区
            $province = db('city') -> where(['id'=>$itemata['item_area']]) -> value('pid');
            $itemata['cate_pid'] = empty($itemata['cate_pid']) ? 2 : $itemata['cate_pid'];
            $itemata['cate_id'] = empty($itemata['cate_id']) ? 2 : $itemata['cate_id'];
            $itemata['province'] = empty($province) ? 1 : $province;
            $itemata['city'] = empty($itemata['item_area']) ? 1 : $itemata['item_area'];
            //获取用户
            $userdata = db('user') -> where(['type'=>1]) -> order('rtime desc') -> select();
            foreach ($userdata as $key => $value) {
                $userData[$key]['uid'] = $value['uid'];
                $userData[$key]['cname'] = $value['cname'];
                $userData[$key]['name'] = $value['name'];
                $userData[$key]['bname'] = $value['bname'];
                $userData[$key]['username'] = empty($value['uname']) ? '' : base64_decode($value['uname']);
            }
            $this -> assign('userData',$userData);
            $this -> assign('data',$itemata);
            return view();
        }
    }

    /*删除项目*/
    public function del_item(){
        $where['id'] = $_POST['id'];
        $eidt['status'] = 0;
        $res = $this -> itemModel -> where($where) -> update($eidt);
        if($res){
            //删除组内项目
            $this -> itemModel -> delGroupItemData($_POST['id']);
            return 1;
        }else{
            return 0;
        }
    }

        /*查看留言*/
    public function get_consult(){
        $consultDB = db('consult');
        //查询留言
        $id = $_GET['id'];
        $where['item_id'] = $id;
        $consultData = $consultDB -> where($where) -> select();
        foreach ($consultData as $key => $value) {
            $consultData[$key]['addtime'] = date('Y-m-d H:i:s',$value['addtime']);
            $consultData[$key]['sex'] = empty($value['sex']) ? '女' : '男';
        }
        $this -> assign('data',$consultData);
        return view();
    }

    /* 新增留言项目列表 */
    public function new_consult_item_list(){
        $consultModel = db('consult');
        //查询出处今日新增留言
        $where['addtime'] = array('egt',strtotime(date("Y-m-d")));
        $consultData = $consultModel -> where($where) -> select();
        $item_id_str = '';
        foreach ($consultData as $key => $value) {
            $item_id_str .= $value['item_id'].',';
        }
        $cateIdArr = array_unique(explode(',',rtrim($item_id_str)));//分割成数组 并且排重
        $itemIdStr = implode(',',$cateIdArr);
        $itemWhere['id'] = array('in',$itemIdStr);
        $itemWhere['status'] = 1;
        $dataList = $this -> itemModel -> getItemData($itemWhere);
        $this -> assign('page',$dataList['page']);
        $this -> assign('data',$dataList['data']);
        return view();
    }

    /*  设置为推荐 && 取消推荐 */
    public function change_edit(){
        $itemModel = db('item');
        $data = input('get.');
        $where['id'] = $data['id'];
        unset($data['id']);
        $result = $itemModel -> where($where) -> update($data);
        //验证操作是否成功
        if($result) {
            $this->success('操作成功');
        }else{
            $this -> success('操作失败');
        }
    }

    /*项目排序*/
    public function item_order(){
        $itemModel = db('item');
        $where['id'] = $_POST['id'];
        $save['order'] = $_POST['order'];
        $result = $itemModel -> where($where) -> update($save);
        if($result){
            echo 1;
        }else{
            echo 0;
        }
    }

    /*  项目详情    */
    public function detail(){
        $id = input('get.id');
        $where['id'] = $id;
       //项目信息
        $data = $this -> itemModel -> getItemDataOnice($where);
       //留言信息
        $cwhere['item_id'] = $id ;
        $cwhere['status'] = 1 ;
        $cdata = model('consult') -> getItemConsultDataList($cwhere,'addtime desc');
        $this -> assign('idata',$data['item']);
        $this -> assign('udata',$data['user']);
        $this -> assign('cdata',$cdata);
        $this -> assign('image',$data['item']['image']);

        return view();

    }

}