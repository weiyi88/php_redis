<?php
require_once dirname(__FILE__)."/../config/db.php";
require_once dirname(__FILE__)."/../config/help.php";

$help=new help();

$redis=$help->redis();
$db=DB::getIntance();
$redis_name="miaosha";


//死循环，一旦队列出现数据，吧数据存到mysql中去

/**
 * 1，从队列最左侧取出一个值来
 * 2，然后判断这个值是否存在
 * 3，切割出时间，uid
 * 4，保存到数据库中
 * 5，数据库插入的失败的时候的回滚机制
 * 6，释放一下redis
 */


//死循环
while (1){

    //从队列最左侧取出一个值
    $user=$redis->lPop($redis_name);

    //判断这个值是否存在
    if (!$user||$user=='nil'){
        sleep(2);
        continue;
    }

    //切割出时间，uid

    $user_arr=explode('%',$user);
    $insert_data=[
        'uid'=>$user_arr[0],
        'time_stamp'=>$user_arr[1],
    ];

    //保存到数据库中，
    $res=$db->insert('redis_queue',$insert_data);

    //数据库插入的失败时候的回滚机制
    if (!$res){
        $redis->rPush($redis_name,$user);
    }

    sleep(2);

    //释放redis

    $redis->close();

}
