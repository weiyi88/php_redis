<?php
//这个文件主要是配送系统处理队列中的订单，并进行标记的一个文件
require_once dirname(__FILE__)."/../config/db.php";
require_once dirname(__FILE__)."/../config/help.php";
$db=DB::getIntance();
$help=new help();
/**
 * 1,先把要处理的记录更新为等待处理，
 * 2，我们要选择出刚刚更新的这些数据，然后进行配送系统处理
 * 3，是吧这些处理过的程序更新为已完成
 */

//锁定记录
$waiting=['status'=>0];
$lock=['status'=>2];
$res_lock=$db->update('order_queue',$lock,$waiting,2);

if ($res_lock){
    //选择要处理的订单内容
    $res=$db->selectAll('order_queue',$lock);
    //然后配货系统进行处理
    //处理完成之后把订单更新为已处理
    $success=[
        'status'=>1,
    ];

    $res_last=$db->update('order_queue',$success,$lock);
    if ($res_last){
        echo 'Success'.$res_last;
    }else{
        throw new \Exception($res_last);
    }

}else{
    echo "ALL FINISH";
}
