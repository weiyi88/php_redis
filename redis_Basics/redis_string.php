<?php

$dir=dirname(__FILE__);

require_once $dir . '/./help.php';

$help=new help();

$redis = new \Redis();

$redis->connect('127.0.0.1',7200);

//string 操作

$redis->delete('string1');

$redis->set('string1','val1');

$val=$redis->get('string1');

$help->dd($val);

$redis->set('string1',4);

$redis->incr("string1",2);

$val=$redis->get('string1');

$help->dd($val);