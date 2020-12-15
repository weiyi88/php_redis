<?php
require_once dirname(__FILE__)."/../../config/help.php";

$help=new help();
$redis=$help->redis();

/**
 * 场景二
 * 计数器
 */

//视频播放量
$keyprefix='video:play:count:';
$videlid=23;
$key=$keyprefix.$videlid;
//$total=$redis->incr($key);
//incr 将key存储的值，每次递增1，key不存在，初始值1
//$help->dd($total);


//页面访问量
$key2="request:total:";
//$total2=$redis->incr($key2);
//$help->dd($total2);

//投票量
//点赞量，类似

//统计每天页面访问量
$key3='request:total:'.date('Ymd');
$help->dd($key3);
echo 'redis 统计每天访问量'.PHP_EOL;
$total3=$redis->incr($key3);
$help->dd($total3);

//定时存，每天，每小时，跑脚本，将数据存到db中
//存在误差，时间间隔的误差，redis挂掉误差
//高重要，还是立刻存db
$toget=$redis->get($key3);
//写db

$key4='ps1';
$toget1=$redis->incrBy($key4,rand(1,5));
//incrby按照自己需求自增
$help->dd($toget1);

/*
 * ps:
 * 如果入库后，没有高取出需求，可以将key删掉
 * redis，每次设定最好带过期时间
 * */