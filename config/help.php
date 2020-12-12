<?php
class help{
    public function redis(){
        $redis=new \Redis();
        $redis->connect('127.0.0.1',7200);
        return $redis;
    }

    public function dd($msg){
        echo"<pre>";
        var_dump($msg);
        echo "<pre>";
}
}