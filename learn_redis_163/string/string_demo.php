<?php

require_once dirname(__FILE__) . "/../config/help.php";

$help=new help();
$redis=$help->redis();

//set 字符串存储进redis
$str='Aring';
$key='aa';
$res=$redis->set($key,$str);
//过期时间  key 对应的设置，秒数
$redis->expire($key,2);
$help->dd($res);



//get 字符串取出来
$res=$redis->get($key);

$help->dd($res);

sleep(3);

$help->dd($redis->get($key));