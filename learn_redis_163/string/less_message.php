<?php
require_once dirname(__FILE__)."/../../config/help.php";

$help=new help();
$redis=$help->redis();

$goods=[
    'id'=>12,
    'name'=>'商品1',
    'price'=>29,
];

//过期时间
$expire=3600; //1h
$key_prefix='goods';

$id=12;

//redis要确保key的唯一性，redis整体通过key逻辑
//功能模快，添加功模快前缀，加商品id
$key=$key_prefix.$id;

//set+expire   的组合
$res=$redis->setex($key,$expire,json_encode($goods));

//获取信息
$info=$redis->get($key);
$help->dd(json_decode($info)); //true 返回数组，false返回对象，默认false

//常规工作流程

//1,接收参数
$id=15; //get得到数据

//2,读redis
$key=$key_prefix.$id;
$info=$redis->get($key);

if (!empty($info)){
    $info=json_decode($info,true);
    echo'get from redis'.PHP_EOL;
    $help->dd($info);
    return $info;
}

//3，如果redis找不到，读db
$info=[
    'id'=>15,
    'name'=>'商品1',
    'price'=>29
];

//4,把db取出来的数据，写redis，做缓存
$res=$redis->setex($key,$expire,json_encode($info));

//5，数据返回
echo 'get from db'.PHP_EOL;
$help->dd($info);
return $info;

//总结，请求--->读redis----无--->读db---->存到redis---->返回数据
//优势，在exprie内，db压力小很多

