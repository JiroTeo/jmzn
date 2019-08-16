<?php
namespace app\index\model;

use think\Model;

class Image extends Model{

    private $imageDb; //
    // 构造方法 实例化数据库
    public function __construct(){
        parent::__construct();
        $this -> imageDb = db('image');
    }

    /*  获取广告数据  */
    public function getImageDatList($where){
        $position = config('ADPOS')['WEB']['POSITION'];
        foreach ($position as $key => $value) {
            $where['position'] = $key;
            $data = $this -> imageDb -> where($where) -> order('addtime desc') -> select();
            $dataList[] = $this -> formatImageDataList($data);
        }
        return $dataList;
    }
    /*  格式化广告信息 */
    public function formatImageDataList($data){
        if(empty($data)){   return [];  }
        $link = config('LINK')['WEB'];
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
                    $dataList[$key]['link'] = empty($value['link']) ? '' : "../item/detail?id={$value['link']}";
                    break;
                case 3://链接到文章
                    $dataList[$key]['link'] = empty($value['link']) ? '' :  "../article/detail?id={$value['link']}";
                    break;
                default://外链
                    $dataList[$key]['link'] = $value['link'];
                    break;
            }

            $dataList[$key]['img'] = trim($value['img'],'.');
        }
        return $dataList;
    }
}