<?php

namespace Iosapi\Model;
use Think\Model;

/**
 * Redis存储
 */
class redis extends Model{
    private static $redis;

    /**
     * @param string $host
     * @param int $post
     */
    public function __construct() {
        $this -> redis = new \Redis();
        $redisConf=array(
            'host'=>'127.0.0.1',
            'port'=>'6379',
            'user'=>'root',
            'pwd'=>''
        );
        $ret = $this->redis -> connect($redisConf['host'],$redisConf['port']);
        if ($ret == false) {
            die($this-> redis->getLastError());
        }

        /* user:password 拼接成AUTH的密码 */
        $ret = $this -> redis->auth($redisConf['user'] . ":" . $redisConf['pwd']);
        if ($ret == false) {
            die($this -> redis->getLastError());
        }


    }
    //创建__clone方法防止对象被复制克隆
    public function __clone(){
        trigger_error('Clone is not allow!',E_USER_ERROR);
    }
    //单例方法,用于访问实例的公共的静态方法
    /*
    public static function getRedis(){
        if(!(self::$redis instanceof self)){
            self::$redis = new self;
        }
        return self::$redis;
    }
    */
    /**
     * 设置值 构建一个字符串
     * @param string $key KEY名称
     * @param string $value 设置值
     * @param int $timeOut 时间 0表示无过期时间
     */
    public function set($key, $value, $timeOut=0) {
        $retRes = $this->redis->set($key, $value);
        if ($timeOut > 0)
            $this->redis->expire('$key', $timeOut);
        return $retRes;
    }

    /*
     * 构建一个集合(无序集合)
     * @param string $key 集合Y名称
     * @param string|array $value 值
     */
    public function sadd($key,$value){
        return $this->redis->sadd($key,$value);
    }

    /*
     * 构建一个集合(有序集合)
     * @param string $key 集合名称
     * @param string|array $value 值
     */
    public function zadd($key,$value){
        return $this->redis->zadd($key,$value);
    }
    /*
     * 删除一个集合里面的某个元素(有序集合)
     * @param string $key 集合名称
     * @param string|array $value 值
     */
    public function srem($key,$value){
        return $this->redis->srem($key,$value);
    }
    /**
     * 取集合对应元素
     * @param string $setName 集合名字
     */
    public function smembers($setName){
        return $this->redis->smembers($setName);
    }

    /**
     * 构建一个列表(先进后去，类似栈)
     * 在头部插入
     * @param sting $key KEY名称
     * @param string $value 值
     */
    public function lpush($key,$value){
// echo "$key - $value \n";
        return $this->redis->LPUSH($key,$value);
    }

    /**
     * 构建一个列表(先进先去，类似队列)
     * 在末尾插入
     * @param sting $key KEY名称
     * @param string $value 值
     */
    public function rpush($key,$value){
        return $this->redis->RPUSH($key,$value);
    }

    /**
     * 返回列表的长度
     * @param $key
     * @return int
     */
    public function lLen($key){
        return $this -> redis -> LLEN($key);
    }
    /**
     * 获取指定的key的内容
     * @param $key
     * @return array
     */
    public function keys($key){
        $result = $this->redis->KEYS($key);
        return $result;
    }
    /**
     * 删除缓存,并返回保存列表在key的第一个元素。
     * @param $key
     * @return string
     */
    public function lpop($key){
        $result = $this->redis->lPOP($key);
        return $result;
    }

    /**
     * 删除缓存中最后一条数据并且返回
     * @param $key
     * @return string
     */
    public function rpop($key){
        $result = $this->redis->RPOP($key);
        return $result;
    }

    /**
     * 删除缓存中等于$value的值
     * @param $key
     * @param int $count
     * @param $value
     */
    public function lrem($key,$value,$count=0){
        $result = $this->redis->lRem($key,$value,$count);
        return $result;
    }
    /**
     * 获取所有列表数据（从头到尾取）
     * @param sting $key KEY名称
     * @param int $head 开始
     * @param int $tail 结束
     */
    public function lranges($key,$head,$tail){
        return $this->redis->lrange($key,$head,$tail);
    }

    /**
     * 获取列表制定的key的value
     * @param $key
     * @param $index
     * @return String
     */
    public function lindex($key,$index){
        return $this->redis->lIndex($key,$index);
    }
    /**
     * HASH类型
     * @param string $tableName 表名字key
     * @param string $key 字段名字
     * @param sting $value 值
     */
    public function hset($tableName,$field,$value){
        return $this->redis->hset($tableName,$field,$value);
    }

    /**
     * 返回名称为$tableName的hash中key对应的value
     * @param $tableName 表的名字
     * @param $field 字段名字
     * @return string 值
     */
    public function hget($tableName,$field){
        return $this->redis->hget($tableName,$field);
    }

    /**
     * 返回名称为$tableName的hash中元素个数
     * @param $tableNam
     * @return array
     */
    public function hvals($tableName){
        return $this->redis->hvals($tableName);
    }

    /**
     * 获取hash中全部的key
     * @param $tableName
     * @return array
     */
    public function hkeys($tableName){
        $result = $this -> redis -> hKeys($tableName);
        return $result;
    }
    /*
     * 删除名称hash中制定的key
     * @param $tableName
     * @param $key
     * @return int
     */
    public function hdel($tableName,$key){
        return $this->redis->hDel($tableName,$key);
    }
    /**
     * 设置多个值
     * @param array $keyArray KEY名称
     * @param string|array $value 获取得到的数据
     * @param int $timeOut 时间
     */
    public function sets($keyArray, $timeout) {
        if (is_array($keyArray)) {
            $retRes = $this->redis->mset($keyArray);
            if ($timeout > 0) {
                foreach ($keyArray as $key => $value) {
                    $this->redis->expire($key, $timeout);
                }
            }
            return $retRes;
        } else {
            return "Call " . __FUNCTION__ . " method parameter Error !";
        }
    }

    /**
     * 通过key获取数据
     * @param string $key KEY名称
     */
    public function get($key) {
        $result = $this->redis->get($key);
        return $result;
    }

    /**
     * 同时获取多个值
     * @param ayyay $keyArray 获key数值
     */
    public function gets($keyArray) {
        if (is_array($keyArray)) {
            return $this->redis->mget($keyArray);
        } else {
            return "Call " . __FUNCTION__ . " method parameter Error !";
        }
    }

    /**
     * 获取所有key名，不是值,(集群内不可用)
     */
    public function keyAll() {
        return $this->redis->keys('*');
    }

    /**
     * 删除一条数据key
     * @param string $key 删除KEY的名称
     */
    public function del($key) {
        return $this->redis->delete($key);
    }

    /**
     * 同时删除多个key数据
     * @param array $keyArray KEY集合
     */
    public function dels($keyArray) {
        if (is_array($keyArray)) {
            return $this->redis->del($keyArray);
        } else {
            return "Call " . __FUNCTION__ . " method parameter Error !";
        }
    }

    /**
     * 数据自增
     * @param string $key KEY名称
     */
    public function increment($key) {
        return $this->redis->incr($key);
    }
    /**
     * 数据自减
     * @param string $key KEY名称
     */
    public function decrement($key) {
        return $this->redis->decr($key);
    }


    /**
     * 判断key是否存在
     * @param string $key KEY名称
     */
    public function isExists($key){
        return $this->redis->exists($key);
    }

    /**
     * 重命名- 当且仅当newkey不存在时，将key改为newkey ，当newkey存在时候会报错哦RENAME
     * 和 rename不一样，它是直接更新（存在的值也会直接更新）
     * @param string $Key KEY名称
     * @param string $newKey 新key名称
     */
    public function updateName($key,$newKey){
        return $this->redis->RENAMENX($key,$newKey);
    }

    /**
     * 获取KEY存储的值类型
     * none(key不存在) int(0) string(字符串) int(1) list(列表) int(3) set(集合) int(2) zset(有序集) int(4) hash(哈希表) int(5)
     * @param string $key KEY名称
     */
    public function dataType($key){
        return $this->redis->type($key);
    }
    /**
     *
     * 获取sets长度
     */
    public function scard($key){
        return $this->redis->scard($key);
    }
    /**
     * 清空数据
     */
    public function flushAll() {
        return $this->redis->flushAll();
    }
    /**
     * 设置哈希操作方法
     */
    public function hmset($key,$array,$time='') {
        if($this->redis->hmset($key,$array)){
            if(!empty($time)){
                if($this->redis->expire($key,$time)){
                    return true;
                }
            }else{
                return true;
            }
        }else{
            return false;
        }
    }
    /**
     * 判断哈希内有无某个值
     */
    public function hexist($key,$filed){
        return $this->redis->hexist($key,$filed);
    }
    /**
     * 获取哈希内字段长度
     */
    public function hlen($key){
        return $this->redis->hlen($key);
    }
    /**
     * 获取所有哈希字段
     */
    public function hgetall($key){
        return $this->redis->hgetall($key);
    }
    /**
     * 设置键值过期时间
     */
    public function expire($key,$time){
        return $this->redis->expire($key,$time);
    }
    /**
     * 返回redis对象
     * redis有非常多的操作方法，只封装了一部分
     * 拿着这个对象就可以直接调用redis自身方法
     * eg:$redis->redisOtherMethods()->keys('*a*') keys方法没封
     */
    public function redisOtherMethods() {
        return $this->redis;
    }

}
