<?php

require_once dirname(__FILE__)."/../config/help.php";

//首先加载redis组件

$redis=new help();
$redis=$redis->redis();

$redis_name='miaosha';

//准备条件
for ($i=0;$i<100;$i++) {
    $uid = rand(10000, 99999);


//1接收用户uid
//$uid=$_GET['uid'];
//获取redis里面已有的数量
    $num = 10;
//如果当天人数少于10时候，则加入这个队列
    if ($redis->lLen($redis_name) < 10) {
        $redis->rPush($redis_name, $uid . '%' . microtime());
        echo $uid . "秒杀成功";
    } else {
//如果当天人数达到了十个人，则返回秒杀完成
        echo "秒杀已结束";

    }
}
$redis->close();