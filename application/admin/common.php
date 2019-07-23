<?php

 /*图片上传*/
     function uploade(){
     	$key = key($_FILES);    //获取数组下标
     	$file = request()->file( $key ); //获取文件内容
     	// 移动到框架应用根目录/public/uploads/ 目录下
     	$fileName = '';
     	$path = './public/uploads/';
     	if( !is_dir( $path ) ){
         	@mkdir( $path, 0777, true ); //如果目录不存在，则生成
     	}
     	$date = date('Ymd/');
     	if( !is_dir( $date ) ){
         	@mkdir( $date, 0777, true ); //如果目录不存在，则生成
     	}
	 
     	$fileName =   $date . uniqid() . '.png'; 
     	$image = \think\Image::open( $file );
     	$image->thumb(300,300,\think\Image::THUMB_CENTER)->save( $path . $fileName );
     	return $fileName;
 	}

 	/*多图上传*/
    function uploades(){
       $files = request()->file('image');
        foreach($files as $file){
            // 移动到框架应用根目录/public/uploads/ 目录下
            $info = $file->move(ROOT_PATH . 'public' . DS . 'uploads');
            if($info){
            // 成功上传后 获取上传信息
//            $images[] = $info->getExtension();
            $images[] = "/uploads/".date("Ymd").'/'.$info->getFilename();
            }else{
                echo 1;
            }
        }
        return $images;
    }
 	function tst($res){
         $data['file'] = $res;
         $data['file'] = '這是一個測試方法，查看是否能直接調用';
         return $data;
}