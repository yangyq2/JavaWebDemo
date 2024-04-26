<?php
header('content-type:text/html;chrset=utf-8');
$server = "localhost";
$user = "root";
$password = "";
$db = "mydb";

//创建链接
$mysqli = new mysqli($server,$user,$password,$db);//检测连接
if($mysqli->connect_error){
    die("链接失败：".$conn->connect_error);
}
$mysqli->set_charset('utf8');//设置字符集
echo "连接成功<br>";
//预处理设置
$sql = "insert into user(username,brief)values(?,?)";
$mysqli_stmt = $mysqli->prepare($sql);//准备预处理语句
//
$username ="小猪同学";
$brief="一个很友好的同学";
//s代表string类型
$mysqli_stmt->bind_param('ss',$username,$brief);

//执行预处理语句
if($mysqli_stmt->execute()){
    echo $mysqli_stmt->insert_id;//程序成功，返回插入数据表的行id
    echo PHP_EOL;
}else{
    echo $mysqli_stmt->error;//执行失败，错误信息
}
mysqli_close($mysqli)
?>