<?php

require_once dirname(__FILE__) . '/../config/db.php';


//接收用户手机号
if (!empty($_GET['mobile'])){
    $order_id=rand(10000,99999);
    //订单中心的处理流程
    //。。。。
    //吧用户get过来的数据进行过滤

    //吧生成的订单信息存入对列表中
    $insert_data=[
        'order_id'=>$order_id,
        'mobile'=>$_GET['mobile'],
        'created_at'=>date('Y-m-d H:i:s',time()),
        'status'=>0,
    ];

    $db=DB::getIntance();
    $res=$db->insert('order_queue',$insert_data);
    if ($res){
        echo $insert_data['order_id'].'保存成功';
    }else{
        echo '保存失败';
    }

}