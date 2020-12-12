<?php
$dir=dirname(__FILE__);
require_once $dir . '/./help.php';

$help= new help();

$redis=$help->redis();

//list操作，队列操作

$redis->del('list1');

$redis->lPush('list1',"A");
$redis->lPush('list1',"B");
$redis->lPush('list1',"C");

$val=$redis->rPop('list1');

$help->dd($val);