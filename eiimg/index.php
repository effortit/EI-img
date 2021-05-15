<?php

header("content-type:text/html;charset=utf-8");

error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING);

//dbname为数据库名称，该处设置为gateway
$dsn="mysql:dbname=gateway;host=localhost";
$db_user='root'; //连接数据库的账号
$db_pass=''; //连接数据库的密码
//PDO为PHP连接数据库的操作类
try{
    $pdo=new PDO($dsn,$db_user,$db_pass);
}catch(PDOException $e){
    echo '数据库连接失败'.$e->getMessage();
}
//该sql语句是更新网关数据到数据库表，保存起来
$sql="update gateway_user set data='" . $_GET["dt"] . "', updatetime='" . time() . "' where `did` = '". $_GET["did"] ."' and `dkey` = '". $_GET["key"] ."'";
$res=$pdo->exec($sql);
//查询最新的操作指令
$sql="select * from gateway_user where `did` = '". $_GET["did"] ."' and `dkey` = '". $_GET["key"] ."'";
$res=$pdo->query($sql);
foreach($res as $row){
    echo ( $row['ctrl'] ); //将操作指令打印出来
}
