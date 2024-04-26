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

getUser($mysqli);

//读取全部用户信息并显示
function getUser($mysqli){
    //预处理设置
    $sql = "SELECT username,age,gender FROM test WHERE username=? and password=?";
    $mysqli_stmt = $mysqli->prepare($sql);//准备预处理语句
 
    //定于要存值的变量
    $uname = $_POST['username'];
    $password = $_POST['passwd'];
    //echo "当前password的值:".$password;

    $mysqli_stmt->bind_param('ss',$uname,$password);

    //执行预处理语句
    if($mysqli_stmt->execute()){
        $username = null;
        $age = null;
        $gender = null;

        //bind_result 绑定的结果集中的值到变量
        $mysqli_stmt->bind_result($username,$age,$gender);

        //遍历结果表
        while($mysqli_stmt->fetch()){
            //echo "用户ID：".$uid; 
            echo "欢迎我们尊贵的VIP用户:".$username;
            echo "<br>";
            echo "年龄：".$age;
            echo "<br>";
            $gender = $gender == 0?"女":"男";
            echo "性别：".$gender;
            echo "<br>";
        }
    }
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}
$mysqli->close();
