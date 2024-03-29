<?php
namespace app\index\controller;
use app\admin\controller\image;
use app\index\model\Article as artModel;
use app\index\model\Image as imageModel;
use app\index\model\Item as itemModel;
use app\index\model\Comment as comModel;
class article extends Base{

    private $artModel;
    public function _initialize(){
        parent::_initialize();
        // 实例化y用户模型
         $this->artModel = \model('article');
    }

    /*  行业资讯页面  */
    public function index(){
        $imageModel = new imageModel();
        $artModel = new artModel();
        $itemModel = new itemModel();
        //广告
        $imageData = $imageModel -> getImageDatList(['status'=>1,'web_page'=>2,'client'=>1]);
        //热门资讯
        $hotArt = $artModel -> getArticleData(['status'=>1],'read_num desc',10,2);
        //加盟资讯
        $jmzx['img'] = $artModel -> getArticleData(['type'=>1,'status'=>1],'addtime desc',2,3);//加盟资讯两条
        $jmzx['list'] = $artModel -> getArticleData(['type'=>1,'status'=>1],'addtime desc','2,11',2);//加盟资讯11条
        //加盟攻略
        $jmglImg = $artModel -> getArticleData(['type'=>2,'status'=>1],'read_num desc',1,1);
        $jmgl['img'] = $jmglImg[0];
        $jmgl['list'] = $artModel -> getArticleData(['type'=>2,'status'=>1],'read_num desc','1,5',2);
        //行业报告
        $hybgImg = $artModel -> getArticleData(['status'=>1,'type'=>0],'id desc',1,1);
        $hybg['img'] = $hybgImg[0];
        $hybg['list'] = $artModel -> getArticleData(['status'=>1,'type'=>0],'id desc','1,8',2);
        //加盟项目排行榜
        $phb = $itemModel -> getItemDataList(['status'=>1],'read_num desc','13',1);
        //分配变量
        $this -> assign('imageData',$imageData);//广告
        $this -> assign('hotArt',$hotArt);//热门资讯
        $this -> assign('jmzx',$jmzx);//加盟资讯
        $this -> assign('jmgl',$jmgl);//加盟攻略
        $this -> assign('hybg',$hybg);//行业报告
        $this -> assign('phb',$phb);//排行榜
//        dump($imageData);die;
        $this -> assign('title','行业资讯');//排行榜
        return view();
    }

    /*  文章详情  */
    public function detail(){
        //定义 && 接收 参数
        $artModel = new artModel();
        $comModel = new comModel();
        $id = $this -> request -> param('id');
        //浏览次数+1
        $artModel -> where('id',$id) -> setInc('read_num',1);
        //获取项目详情
        $data = $artModel -> getArticleDataOnce(['status'=>1,'id'=>$id],$_SESSION['jmzn_web']);//$where,$order=false,$limit=false,$type=0,$user=[],$debug
        //评论
        $comment['data'] = $comModel -> getComment(['topic_id'=>$id,'status'=>1],'addtime desc',false,1,$this -> user);
        $comment['count'] = $comModel -> countNum(['topic_id'=>$id,'status'=>1]);
        //热门资讯
        $hotArt = $this -> artModel -> getArticleData(['status'=>1],'read_num desc',10,2);

        //分配变量
        $this -> assign('data',$data);
        $this -> assign('comment',$comment);
        $this -> assign('hotArt',$hotArt);
        return view();

    }

    /*  文章列表    */
    public function artlist(){
        //接收 && 定义参数
        $artModel = new artModel();
        $itemModel = new itemModel();
        $type = $this -> request -> param('type');
        $page = '';
        $where['status'] = 1;
        $where['type'] = (int)$type;
        $data = $artModel -> getArticleDataByPage($where,'reco desc , id desc ',10,3,$page);

        //加盟项目排行榜
        $ranking = $itemModel -> getItemDataList(['status'=>1],'read_num desc',13,1);
        //分配变量
        $this -> assign('data',$data);
        $this -> assign('ranking',$ranking);
        $this -> assign('page',$page);
        $this -> assign('type',(int)$type);
        $this -> assign('title','行业资讯');
        return view();



    }


    /*  热门资讯【右侧边栏】  */
    public function hotArticle($fail = true){
        $artModel = new artModel();
        //获取数据
        $data = $this -> artModel -> getArticleData(['status'=>1],'read_num desc',10,2);
        //分配变量
        $this -> assign('data',$data);
        dump($data);
    }

    /*  行业资讯【右侧边栏】  */
    public static function industryArticle(){
        $artModel = new artModel();
        //获取两条推荐的文章
        $artImg = $artModel -> getArticleDataForReco(['status'=>1,'reco'=>1],'addtime desc',1,1);
        $where['status'] = 1;
        $where['id'] = ['neq',$artImg['id']];
        $artList = $artModel -> getArticleData($where,'addtime desc',7,2);
        //分配变量
        dump($artImg);
        dump($artList);
    }


    /*  文章列表    加盟资讯-加盟攻略-行业报告 我的收藏 */
    public function article_list(){
        //接收参数 && 定义参数 && 验证参数
        $type = empty($_REQUEST['type']) ? 0 : $_REQUEST['type'];//类型
        $isFow = empty($_REQUEST['is_fow']) ? 0 : $_REQUEST['is_fow'];//1收藏0列表
        //分页
        $page = empty($_REQUEST['page']) ? 0 : $_REQUEST['page'];
        $num = $page * 7;
        $limit = $num .',7';
        //条件
        $where['type'] = $type;//类型 0行业报告1加盟资讯2加盟攻略
        $where['status'] = 1;//状态 0无效1有效
        //验证是否为收藏
        if($isFow == 1){
            if(empty($this -> user)){//眼整登录
                wapReturn($this -> returnCode['ERROR'][5]);
            }
            $fmodel = model('follow');
            $fwhere['uid'] = $this -> user['uid'];//用户id
            $fwhere['status'] = 1;//状态有效
            $fwhere['ftype'] = 3;//类型为收藏文章
            $aIds = $fmodel -> getTid($fwhere);
            $where['id'] = array('in',$aIds);
        }//收藏条件end
        //获取文章数据
        $dataList['data'] = $this -> artModel -> getArticleData($where,'addtime desc',$limit,3);//where/order/limit/type/user
        $dataList['count'] = $this -> artModel -> artCount($where);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $dataList;
        wapReturn($rinfo);
    }

    /*文章详情*/
    public function art_detail(){
        $debug = empty($_REQUEST['debug']) ? 0 : $_REQUEST['debug'];
        //接收参数 && 定义条件 && 查询数据
        $where['id'] = empty($_REQUEST['id']) ? 0 : $_REQUEST['id'];
        $where['status'] = 1;
        $data = $this -> artModel -> getArticleDataOnce($where,$this -> user,$debug);//$where,$order=false,$limit=false,$type=0,$user=[],$debug
        if(empty($data)){
            $rinfo = $this -> returnCode['ERROR'][4];
            $data = [];
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }

    /*首页-行业资讯*/
    public function get_index_reco_article(){
        //定义条件 && 获取文章数据
        $where['status'] = 1;
        $where['reco'] = 1;
        //获取两条推荐的文章
        $data = $this -> artModel -> getArticleData($where,'addtime desc',2,1);
        if(empty($data)){
            $rinfo = $this -> returnCode['ERROR'][0];
        }
        foreach ($data as $key => $value) {
            $dataList[$key]['rArticle'] = $data[$key];
            //获取最新的文章 定义读取条数
            $num = $key*7;
            $limit = $num.',7';
            $dataList[$key]['aticle'] = $this -> artModel -> getArticleData('','addtime desc',$limit,2);
        }
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $dataList;
        wapReturn($rinfo);
    }
     /* 行业资讯-行业报告*/
    public function get_article_new(){
        //定义条件 && 获取文章数据
        $where['status'] = 1;
        $where['reco'] = 1;
        //获取两条推荐的文章
        $data['rArticle'] = $this -> artModel -> getArticleData($where,'addtime desc',1,1);
        $data['aticle'] = $this -> artModel -> getArticleData('','addtime desc',7,2);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }
    /*行业资讯-right侧边栏 热门资讯*/
    public function get_hot_article(){
        $where['status'] = 1;
        $data = $this -> artModel -> getArticleData($where,'read_num desc',10,2);
        if(empty($data)){
            $rinfo = $this -> returnCode['ERROR'][1];
            $data = [];
        }else{
            $rinfo = $this -> returnCode['SUCCESS'][0];
        }
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }
    /*  行业资讯-加盟资讯-*/
    public function information(){
        //定义参数&&查询出数据
        $where['type'] = 1;
        $where['status'] = 1;
        $data['info'] = $this -> artModel -> getArticleData($where,'addtime desc',2,3);
        $where['type'] = 2;
        $data['stra'] = $this -> artModel -> getArticleData($where,'addtime desc',11,2);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }

    /*  行业资讯-加盟攻略   */
    public function strategy(){
        //定义参数 && 查询出数据
        $where['type'] = 2;
        $where['status'] = 1;
        //浏览量最高的1条攻略数据/展示封面图
        $data['img'] = $this -> artModel -> getArticleData($where,'read_num desc',1,1);
        //浏览量最多的5条攻略数据。展示标题/
        $data['list'] = $this -> artModel -> getArticleData($where,'read_num desc','1,5',2);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }
    /*  行业资讯-行业报告   */
    public function presentation(){
        //定义参数 && 查询出数据
        $where['type'] = 0;
        $where['status'] = 1;
        //行业报告最新的一条数据
        $data['img'] = $this -> artModel -> getArticleData($where,'addtime desc',1,1);
        //行业报告最新的8条数据（跳过第一条）
        $data['list'] = $this -> artModel -> getArticleData($where,'addtime desc','1,8',2);
        $rinfo = $this -> returnCode['SUCCESS'][0];
        $rinfo['data'] = $data;
        wapReturn($rinfo);
    }
}