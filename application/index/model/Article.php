<?php
namespace app\index\model;

use think\Model;

class article extends Model{

    /*  todo    获取文章列表数据
     *  todo    获取文章数据
     *  todo    格式化文章详情数据
     *  todo    格式化-首页-推荐文章-数据
     *  todo    格式化-首页-行业资讯-最新7条文章-数据
     *  todo    格式化-行业资讯-加盟咨询
     * **/

    private $articleModel; //
    //构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> articleModel = db('article');
    }

    /*  分页模式获取文章数据  */
    public function getArticleDataByPage($where,$order=false,$num=false,$type=0,&$page){
        $articleData = $this -> articleModel -> where($where) -> order($order) -> paginate($num,false,['var_page'=>'a']);
        $page = $articleData ->render();
        $data = iterator_to_array($articleData);
        if(empty($data)){   return [];  }
        switch ($type) {
            case 1://首页推荐文章 图片-标题
                $data = $this -> formatIndexArticleData ($data);
                break;
            case 2://首页-行业资讯-最新7条文章-数据
                $data = $this -> formarIndexNewArticleList ($data);
                break;
            case 3://格式化-行业资讯-加盟咨询  -文章列表
                $data = $this -> formarArticleToInformation ($data);
                break;
            case 4://详情数据
                $data = $this -> formarArticleToInformation ($data);
                break;
            default:
                $data = $this -> formatArticleData ($data);
                break;
        }
        return $data;
    }

    /*获取文章列表数据*/
    public function getArticleData($where,$order=false,$limit=false,$type=0,$user=[],$debug=false){

        $articleData = $this -> articleModel -> where($where) -> order($order) -> limit($limit) -> select();
        if(empty($articleData)){return array();}//数据不存在返回array();
        //格式化数据
        	switch ($type) {
                case 1://首页推荐文章 图片-标题
                    $data = $this -> formatIndexArticleData ($articleData,$debug);
                    break;
                case 2://首页-行业资讯-最新7条文章-数据
                    $data = $this -> formarIndexNewArticleList ($articleData,$debug);
                    break;
                case 3://格式化-行业资讯-加盟咨询  -文章列表
                    $data = $this -> formarArticleToInformation ($articleData,$debug);
                    break;
                case 4://详情数据
                    $data = $this -> formarArticleToInformation ($articleData,$debug);
                    break;
                default:
                    $data = $this -> formatArticleData ($articleData,$debug);
                    break;
            }
        return $data;
    }


    /*  格式化-首页-推荐文章-数据  */
    public function formatIndexArticleData($data){
        $imgConf = config('IMAGE');
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['title'] = $value['title'];
            $image = [];
            $image = explode(',',$value['img']);
            $dataList[$key]['img'] = empty($image[0]) ? '' : trim($image[0],'.');
        }
        return $dataList;
    }
    /*  格式化-首页-行业资讯-最新7条文章-数据   */
    public function formarIndexNewArticleList($data){
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['title'] = $value['title'];
            $dataList[$key]['addtime'] = date("Y-m-d",$value['addtime']);
        }
        return $dataList;
    }
    /*  格式化-行业资讯-加盟咨询   */
    public function formarArticleToInformation($data){
        $perfix = config('IMAGE');
        foreach ($data as $key => $value) {
            $dataList[$key]['id'] = $value['id'];
            $dataList[$key]['title'] = $value['title'];
            $dataList[$key]['type'] = $value['type'];
            $image = [];
            $image = explode(',',$value['img']);
            $dataList[$key]['img'] = empty($image[0]) ? '' : trim($image[0],'.');
            $dataList[$key]['sign'] = $value['sign'];
            $dataList[$key]['read_num'] = $value['read_num'];
            $dataList[$key]['addtime'] = date("Y-m-d",$value['addtime']);
        }
        return $dataList;
    }
    /*获取单条文章数据*/
    public function getArticleDataOnce($where,$user = false,$debug = false ){
        $data = $this -> articleModel -> where($where) -> find();
        if(empty($data)){   return [];  }
        //格式化数据
        $dataList = $this -> formatAticleDetail($data,$user['uid'],$debug);
        return $dataList;
    }
    /*  格式化文章详情数据   单条*/
    public function formatAticleDetail($data,$uid,$debug){
        $formatData['id'] = $data['id'];
        $formatData['title'] = $data['title'];//文章标题
        $formatData['detail'] = $data['detail'];//详情
        $formatData['type'] = $data['type'];//
        switch ($data['type']) {
            case 1:
                $formatData['mode'] = '行业资讯';//
                break;
            case 2:
                $formatData['mode'] = '加盟攻略';//
                break;
            default:
                $formatData['mode'] = '行业报告';//
                break;
        }
        $formatData['addtime'] = date("Y-m-d",$data['addtime']);//详情
        $formatData['read_num'] = $data['read_num'];//详情
        $formatData['uid'] = $data['uid'];//详情
        //发布人
        $username = db('user') -> where(['uid'=>$data['uid']]) ->value('uname');
        $formatData['username'] = empty($username) ? '' : base64_decode($username);
        //收藏状态
        if(empty($uid)){
            $formatData['is_fow'] = 0;
        }else{
            $count = db('follow') -> where(['ftype'=>3, 'status'=>1, 'uid'=> $uid , 'tid'=>$data['id']]) -> count();
            $formatData['is_fow'] = empty($count) ? 0 : 1 ;
        }
        //上一个||下一个
        //上一条||下一条
        $formatData['prev'] = $this -> articleModel -> where(['status'=>1,'id'=>['LT',$data['id']]]) -> order('id desc') -> field('id,title') -> find();
        $formatData['next'] = $this -> articleModel -> where(['status'=>1,'id'=>['GT',$data['id']]]) -> order('id asc') -> field('id , title') -> find();
        return $formatData;
    }

    /*  获取文章的总数 */
    public function artCount($where){
        $count = $this -> articleModel -> where($where) -> count();
        return $count;
    }

    /*侧边栏项目推荐*/
    public function getArticleDataForReco($where = false ){
        $data = $this -> articleModel -> where($where) -> find();
        if(empty($data)){   return [];  }
        //格式化数据
        $dataList = $this -> formatArticeDataFroReco($data);
        return $dataList;


    }

    /*  格式化-侧边栏-行业资讯内容*/
    public function formatArticeDataFroReco($data){
        $imgConf = config('IMAGE');
        $dataList['id'] = $data['id'];
        $dataList['title'] = $data['title'];
        $image = [];
        $image = explode(',',$data['img']);
        $dataList['img'] = empty($image[0]) ? '' : trim($image[0],'.');
        return $dataList;
    }


}