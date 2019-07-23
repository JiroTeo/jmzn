<?php
namespace app\admin\model;

use think\Model;

class article extends model{

    private static $articleModel; // 

    // 
    public function __construct(){
        parent::__construct();
        $this -> articleModel = db('article');
    }

    /*添加文章*/
    public function addArticle($data){
    	// 存库
    	if($data){
    		// 返回id
    		$res = $this -> articleModel -> insertGetId($data);
    		return $res;
    	}else{
    		return false;
    	}
    }

    /*查询文章数据*/
    public function findArticle($where){
    	$data = $this -> articleModel -> where($where) -> select();
    	return $data;

    }

   /*	删除文章
	*	修改文章装填（伪删除）
    */
    public function delArticle($where,$data){
    	if($where && $data){
    		$res = $this -> articleModel -> where($where) -> update($data);
    		return $res;
    	}else{
    		return false;
    	}
    }
    /*查询一篇文章*/
    public function articleDetail($where){
    	// 查询文章
    	$article = $this -> articleModel -> where($where) -> find();
		// 查询发布人
    	$userModel = model('user');
    	$cond['uid'] = $article['uid'];
        $userData = $userModel -> findUser($cond);
		// 格式化文章数据
        $data['username'] = base64_decode($userData['uname']);		//发布人
        $data['title'] = $article['title'];			//文章标题
        $data['sign'] = $article['sign'];			//文章简介
        $data['detail'] = $article['detail'];		//文章详情
        $data['read_num'] = $article['read_num'];		//浏览量
        $data['addtime'] = date("Y-m-d H:i:s",$article['addtime']);		//发布时间
        // 文章类型
        switch ($article['type']) {
        	case 0:
        			$data['type'] = '行业报告';
        		break;
        	case 1:
        			$data['type'] = '加盟资讯';
        		break;
        	case 2:
        			$data['type'] = '加盟攻略';
        		break;

        	default:
        		$data['type'] = '这不是一篇文章';
        		break;
        }
       	return $data;
    }
}