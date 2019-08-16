<?php
namespace app\admin\controller;

use think\Db;
use think\Controller;

class Index extends Base{

    /*首页*/
    public function index(){
        $groupModel = db('group');
        $where['type'] = 1;
        $where['status'] = 1;
        $groupData = $groupModel -> where($where) -> select();

        $this -> assign('data',$groupData);
        return view();
    }

    /*欢迎页面*/
    public function welcome(){
        //统计总数量
        $itemModel = db('item');
        $articleModel = db('article');
        $userModel = db('user');
        $commentModel = db('comment');
        $consultModel = db('consult');
        $assessModel = db('assess');
        $allData['time'] = date("Y-m-d H:i:s");
        //项目总数
        $allData['item_num'] = $itemModel -> count();
        //文章总数
        $allData['article_num'] = $articleModel -> count();
        //企业用户总数
        $allData['ent_user_num'] = $userModel -> where(array('type'=>1)) -> count();
        //个人用户总是
        $allData['user_num'] = $userModel -> where(array('type'=>0)) -> count();
        //评论总是
        $allData['commnet_num'] = $commentModel -> where(array('pid'=>0)) ->count();
        //回复总是
        $allData['to_commnet_num'] = $commentModel -> where(array('pid'=>array('neq',0))) ->count();
        //咨询总数
        $allData['consult_num'] = $consultModel -> where(array('type'=>0)) -> count();
        //留言总数
        $allData['mess_num'] = $consultModel -> where(array('type'=>1)) -> count();
        //评估总量
        $allData['ass_num'] = $assessModel -> count();
        //统计昨日新增数量
        $yesterdayWhere['addtime'] = array(['egt',strtotime('yesterday')],['elt',strtotime(date('Y-m-d'))],'and');
       //昨日项目新增量
        $yesterdayData['item_num'] = $itemModel -> where($yesterdayWhere) -> count();
        //昨日文章新增量
        $yesterdayData['article_num'] = $articleModel -> where($yesterdayWhere) -> count();
        //昨日用户新增量
        $userWhere['rtime'] = array(['egt',strtotime('yesterday')],['elt',strtotime(date('Y-m-d'))],'and');
        $yesterdayData['user_num'] = $userModel -> where($userWhere) -> count();
        //昨日评论新增量
        $yesterdayData['commnet_num'] = $commentModel -> where($yesterdayWhere) -> count();
        //昨日评估新增
        $yesterdayData['ass_num'] = $assessModel -> where($yesterdayWhere) -> count();
        //昨日咨询新增量
        $yesterdayWhere['type'] = 0;
        $yesterdayData['consult_num'] = $consultModel -> where($yesterdayWhere) -> count();
        //昨日留言新增量
        $yesterdayWhere['type'] = 1;
        $yesterdayData['mess_num'] = $consultModel -> where($yesterdayWhere) -> count();


        //获取服务器版本信息
        $version = Db::query('SELECT VERSION() AS ver');
        $config  = [
            'url'             => $_SERVER['HTTP_HOST'],
            'document_root'   => $_SERVER['DOCUMENT_ROOT'],
            'server_os'       => PHP_OS,
            'server_port'     => $_SERVER['SERVER_PORT'],
            'server_ip'       => $_SERVER['SERVER_ADDR'],
            'server_soft'     => $_SERVER['SERVER_SOFTWARE'],
            'php_version'     => PHP_VERSION,
            'mysql_version'   => $version[0]['ver'],
            'disk_free_space' => number_format(disk_free_space('/')/1048576,2),
            'max_upload_size' => ini_get('upload_max_filesize')
        ];
        $this->assign('config', $config);
        $this -> assign('data',$allData);
        $this -> assign('yesterdayData',$yesterdayData);
//        $php_os = PHP_OS;
//        $this -> assign('PHP_OS',$php_os);
        return view();
    }

    /*图片上传*/
    public function uploadImage(){
        $key = key($_FILES);    //获取数组下标
     	$file = request()->file( $key ); //获取文件内容
     	// 移动到框架应用根目录/public/uploads/ 目录下
     	$path = '../public/uploads/';
     	if( !is_dir( $path ) ){
         	@mkdir( $path, 0777, true ); //如果目录不存在，则生成
     	}
     	$date = date('Ymd/');
     	if( !is_dir( $path.$date ) ){
         	@mkdir( $path.$date, 0777, true ); //如果目录不存在，则生成
     	}
     	$fileName =   $date . uniqid() . '.png';
     	$image = \think\Image::open( $file );

     	$res = $image-> save( $path . $fileName );
//        $image-> thumb(300,300,\think\Image::THUMB_CENTER)->save( $path . $fileName ); //压缩
     	if($res){
     	    echo '{"code":0,"msg":"成功上传","data":{"src":"/uploads/'.$fileName.'"}}';
//     	    echo $path.$fileName;
        }else{
     	    echo '{"code":1,"msg":"上传失败","data":{"src":"/uploads/'.$fileName.'"}}';
        }
    }
    /*多图上传*/
     	/*多图上传*/
    public function uploades(){
       $files = request()->file('image');
        foreach($files as $file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
            // 成功上传后 获取上传信息
            $images[] = $info->getExtension();
//            $images[] = "/uploads/".date("Ymd").'/'.$info->getFilename();
            }else{
                echo 1;
            }
        }
        wapReturn($images);
    }

    /**/
    public function test(){
        $res = getAdConfig();
        dump($res);
    }

    /*    爬虫    */
        public function curl_html_file(){

            $u = $this -> request -> param('u');
            $url = empty($u) ? 'https://www.jiamengzhinan.com' : $u ;

            $html= file_get_contents($url);

            dump($html);
            echo "<h1>以下内容为echo'页面形态'</h1>";
            echo "<HR align=center width=100%;color=#f SIZE=1>";
            echo $html;
    }
}