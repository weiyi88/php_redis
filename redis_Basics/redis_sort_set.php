<?php
$dir=dirname(__FILE__);

require_once $dir . '/./help.php';

$help=new help();

$redis=$help->redis();

//sort set 操作 口语化zset   通常用于排行榜
//zrange 低到高从0开始

$redis->del('zset1');
$redis->zAdd('zset1',100,'aring');
$redis->zAdd('zset1',90,'pp');
$redis->zAdd('zset1',93,'aaa');

$var=$redis->zRange('zset1',0,-1);//0 ,-1表示输出所有
//从低到高
//返回数组

$help->dd($var);

$val=$redis->zRevRange('zset1',0,-1);//从高到低
//返回数组

$help->dd($val);