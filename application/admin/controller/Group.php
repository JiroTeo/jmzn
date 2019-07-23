<?php
namespace app\admin\controller;
    use think\Db;
    use think\Controller;
class group extends Base{
    // 构造方法
    public function __construct()
    {
        parent::__construct();
        // 实例化分类模型
        $this->groupModel = model('article');
    }
     /**/
    public function index(){
        return view();
    }

    /*添加分组*/
    public function add_group(){
        if($_POST){
            $data = $_POST;
            //判断是否上传了图片
            if($_FILES['img']['size'] != 0){//上传了图片就修改img如果没上传则不修改img字段
                // 实例化模型。调用上传文件函数
                $fileName = model('commen') -> uploade($_FILES);
                $data['img'] = $fileName;
            }
            $data['addtime'] = time();
            $data['type'] = 1;
            $res = db('group') -> insertGetId($data);
            if($res){
                $this -> success("添加分组成功");
            }else{
                $this -> error('添加失败');
            }
        }else{
            return view();
        }

    }
    /*删除分组*/
    public function del_group(){
        $where['id'] = $_POST['id'];
        $edit['status'] = 0;
        $res = db('group') -> where($where) -> update($edit);
        if($res){
            $this -> success('删除成功');
        }else{
            $this -> error('删除失败');
        }
    }
    /*添加项目到分组*/
    public function add_item_group(){
        if($_POST){
            $groupSub = db('group_sub');
            $groupId = $_POST['group_id'];
            //查询出本项目所添加的所有组
            $tid = $_POST['id'];
            $gWhere['tid'] = $tid;
            $gWhere['status'] = 1;
            $groupData = $groupSub -> where($gWhere) -> select();
            if($groupData){//存在 证明加入了组
                foreach ($groupData as $key => $value) {
                    $inArr = in_array($value['gid'],$groupId);
                    if(empty($inArr)){//曾经添加过这个组。但是现在么有。删除本组
                        $where['id'] = $value['id'];
                        $data['status'] = 0;
                        $res = $groupSub -> where($where) -> update($data);
                    }else{//存在数组中。
                         unset($groupId[array_search($value['gid'],$groupId)]);//删除数组中的指定元素。
                    }
                }
            }
            //添加数据
            foreach ($groupId as $key => $value) {
                $data['gid'] = $value;
                $data['tid'] = $_POST['id'];
                $data['status'] = 1;
                $data['addtime'] = time();
                $res = $groupSub -> insertGetId($data);
                echo $res;
            }
            $this -> success('添加成功');
        }else{
            //根据id查询出分组
            $where['tid'] = $_GET['id'];
            $itemSub = db('group_sub') -> where($where) -> select();
            foreach ($itemSub as $key => $value) {
                $groupIds[] = $value['gid'];
            }
            //查询出来所有的分组
            $groupWhere["status"] = 1;
            $groupData = db('group') -> where($groupWhere) -> select();
            if(!empty($groupIds)){
                foreach ($groupData as $key => $value) {
                    $res = in_array($value['id'],$groupIds);
                    if($res){
                        $groupData[$key]['ch'] = 'checked';
                    }else{
                        $groupData[$key]['ch'] = '';
                    }
                }
            }else{
                foreach ($groupData as $key => $value) {
                    $groupData[$key]['ch'] = '';
                }
            }

            $this -> assign('data',$groupData);
            $this -> assign('id',$_GET['id']);
            $this -> assign('itemSub',$itemSub);
            return view();
        }
    }

    /*  设置/取消为品牌精选-展示品牌名
     *  设置/取消为品牌精选-展示封面图
     *  移除项目出组
     * **/
    public function changeGroupSub(){
        $data = input('get.');
        $type = empty($data['type']) ? false : $data['type'];
        $where['tid'] = $data['tid'];
        $where['gid'] = $data['gid'];
        if($type == 'del'){
            $data['reco_img'] = 0;
            $data['reco_brand'] = 0;
        }
        $res = db('group_sub') -> where($where) -> update($data);
//        echo  db('group_sub') -> getLastSql();die;
        if($res){
            $this -> success('SUCCESS');
        }else{
            $this -> error('LOSE');
        }
    }
}