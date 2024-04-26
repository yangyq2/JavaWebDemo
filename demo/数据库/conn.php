<?php
$server = "localhost";
$user = "root";
$password = "";
$db = "mydb";
//创建链接
$conn = new mysqli($server,$user,$password,$db);//检测连接
if($conn->connect_error){
    die("链接失败：".$conn->connect_error);
}
// $conn->set_charset('utf8');//设置字符集
// echo "连接成功<br>";
// //预处理设置
// $sql = "insert into user(username,brief)values(?,?)";
// $conn_stmt = $mysqli->prepare($sql);//准备预处理语句
// $username ="小猪同学";
// $brief="一个很友好的同学";
// //s代表string类型
// $conn_stmt->bind_param('ss',$username,$brief);

// //执行预处理语句
// if($conn_stmt->insert()){
//     echo $conn_stmt->insert_id;//程序成功，返回插入数据表的行id
//     echo PHP_EOL;
// }else{
//     echo $conn_stmt->error;//执行失败，错误信息
// }
// //增加操作
// $add = "INSERT INTO user (uid,username) VALUES(3,'jack')";
// //检测新加入的记录是否成功
// if($conn->query($add) === TRUE){
//     echo "新纪录插入成功";
// }else{
//     echo "Error:" . $add . "<br>" . $conn->error;
// }
//删除操作
$del = "DELETE FROM user WHERE username = 'jack'";
mysqli_query($conn,$del);//执行语句
echo "删除成功";

$conn->close();
?>