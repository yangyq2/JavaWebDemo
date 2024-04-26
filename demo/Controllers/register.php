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

    register($mysqli);
    //getUserList($mysqli);
    

    //用户注册，插入新数据
    function register($mysqli){
        $sql = "insert into test(username,password)values(?,?)";
        $mysqli_stmt = $mysqli->prepare($sql);//准备预处理语句

        //传入需要注册的用户名和密码
        $username =$_POST["username"];
        $passwd = $_POST["password"];

        //s代表string类型 i代表int类型
        $mysqli_stmt->bind_param("ss",$username,$passwd);

        //执行预处理语句
        if($mysqli_stmt->execute()){
            echo $mysqli_stmt->insert_id;//程序成功，返回插入数据表的行id
            echo PHP_EOL;
            echo "<script>alert('恭喜你，登录成功');window.location.href='../View/login.html'</script>";
        }else{
            echo $mysqli_stmt->error;//执行失败，错误信息
        }
        //释放结果集
        $mysqli_stmt->free_result();
        $mysqli_stmt->close(); 
    } 
    $mysqli->close();
?>