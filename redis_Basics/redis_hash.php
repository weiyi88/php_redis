<?php
$dir=dirname(__FILE__);

require_once $dir . '/./help.php';

$help =new help();

$redis=$help->redis();

//hash操作，适合存储复杂数据结构

$redis->del('driver1');
$redis->hSet('driver1','name','aring');
$redis->hSet('driver1','age',23);
$redis->hSet('driver1','sex',1);
$val=$redis->hGet('driver1','name');
$help->dd($val);

//获取多个
$val=$redis->hMGet('driver1',['name','age']);//返回数组
$help->dd($val);