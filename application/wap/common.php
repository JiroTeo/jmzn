<?php

use think\Config;
use Wechat\Loader;

function & load_wechat($type = ''){

    static $wechat = array();
    $index = md5(strtolower($type));
    if (!isset($wechat[$index])) {
        $config = Config::get('wechat');
        $config['cachepath'] = CACHE_PATH . 'Data/';
        dump($config);
        $wechat[$index] = Loader::get($type, $config);
    }
    return $wechat[$index];

}