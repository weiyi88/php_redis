<?php

require_once dirname(__FILE__)."/./db_config.php";

class dbMyself{

    public $conn=null;

    public function __construct($config)
    {
        $conn=mysqli_connect($config['host'],$config['username'],$config['passwor'],$config['database'],'3306');
        if (!$conn){
            throw new \Exception('链接错误'.mysqli_connect_error());
        }
    }

    //查询构造器
    public function getResult($sql){
        $date=mysqli_query($this->conn,$sql);

        $date=get_object_vars($date);

        return $date;
    }
}

