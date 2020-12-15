<?php
require_once dirname(__FILE__)."/../../config/help.php";

$help=new help();
$redis=$help->redis();


//共享session
$keyprefix='login:uid:';
$id=19;
$key=$keyprefix.$id;
$sessionExpre=3600;

//1,登录，设置session

//db获取用户信息
$userinfo=[
    'name'=>'Aring',
    'email'=>'tantubuping@163.com',
];

//中session缓存
$rand1=rand(10000,99999);//生成一个随机数
$rand2=rand(10000,99999);//生成一个随机数

$cookie=md5(sprintf("%d_%d_%d_%d",$id,$rand1,$rand2,time()));

$res=$redis->setex($cookie,$sessionExpre,json_encode($userinfo));

//种浏览器cookie
$cookieExprie=time().$sessionExpre;
$domain='.aring88.xyz';
setcookie('LOGIN',$cookie,$cookieExprie,'/',$domain);

//2.判断登录状态

//从浏览器获取cookie，PHP：$cookie=$_COOKIE['LOGIN']
$cookieNow=$cookie;

//$userinfo非空，已经登录，如果为空，跳转登录页面
$userinfo=$redis->get($cookieNow);

//3,登出

$res=$redis->del($cookie);

//清空cookie
setcookie("LOGIN",'',time()-86400,'/',$domain);

