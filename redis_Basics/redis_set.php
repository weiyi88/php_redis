<?php
$dir=dirname(__FILE__);

require_once $dir . '/./help.php';

$help=new help();

//set 操作

$redis=$help->redis();

$redis->del('set1');

$redis->sAdd('set1','A');
$redis->sAdd('set1','B');
$redis->sAdd('set1','C');
$redis->sAdd('set1','C');

$val=$redis->sCard('set1');

$help->dd($val);

$val=$redis->sMembers('set1');//返回数组

$help->dd($val);
