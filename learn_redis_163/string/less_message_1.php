<?php
require_once dirname(__FILE__)."/../../config/help.php";

$help=new help();
$redis=$help->redis();

$key_prefix='goos';

//1,后台改了商品信息

//2,清缓存，前端用户感知到数据更改

$id=15;
$key=$key_prefix.$id;
$res=$redis->del($key);

$info=$redis->get($key);

$help->dd($info);