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

//register($mysqli);
getUserList($mysqli);
$mysqli->close();

//用户注册，插入新数据
function register($mysqli){
    $sql = "insert into user(username,age,gender,brief)values(?,?,?,?)";
    $mysqli_stmt = $mysqli->prepare($sql);//准备预处理语句
    //
    $username =$_GET["username"];
    $age = $_GET["age"];
    $gender = $_GET["gender"];
    $brief="";
    //s代表string类型 i代表int类型
    $mysqli_stmt->bind_param('siis',$username,$age,$gender,$brief);

    //执行预处理语句
    if($mysqli_stmt->execute()){
        echo $mysqli_stmt->insert_id;//程序成功，返回插入数据表的行id
        echo PHP_EOL;
    }else{
        echo $mysqli_stmt->error;//执行失败，错误信息
    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}
//读取全部用户信息并显示
function getUserList($mysqli){
    //预处理设置
    $sql = "SELECT username,age,gender,brief FROM user";
    $mysqli_stmt = $mysqli->prepare($sql);//准备预处理语句

    //定于要存值的变量
    $uid = null;
    $age = null;
    $gender = null;

    //预查询的ID
    // $id = 1;
    // $mysqli_stmt->bind_param("i",$id);

    //执行预处理语句
    if($mysqli_stmt->execute()){
        //bind_result 绑定的结果集中的值到变量
        $mysqli_stmt->bind_result($username,$age,$gender,$brief);
        //遍历结果表
        while($mysqli_stmt->fetch()){
            //echo "用户ID：".$uid;
            echo "<br>";
            echo "姓名：".$username;
            echo "<br>";
            echo "年龄：".$age;
            echo "<br>";
            $gender = $gender == 0?"女":"男";
            echo "性别：".$gender;
            echo "<br>";
            echo "简介：".$brief;
            echo "<br>";
        }
    }
    //释放结果集
    $mysqli_stmt->free_result();
    $mysqli_stmt->close();
}
?>