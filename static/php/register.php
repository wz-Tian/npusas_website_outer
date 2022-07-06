<?php

header('content-type:text/html;charset="utf-8";Access-Control-Allow-Origin: *');

$username = $_POST['username'];
$password = $_POST['password'];


//对密码加密
$password = md5(md5($password."aaa")."bbb");

// $responddata = ["code"=>"","message"=>""];
$responddata = array("code"=>"","message"=>"");

//创建数据库

//链接数据库
$link = mysqli_connect("localhost","user","123456","user");


if(!$link){
     $responddata['code'] = 0;
     $responddata['message'] = "数据库链接失败";
     echo json_encode($responddata);
    //echo "数据库链接失败";
    exit;
}

error_reporting(1);
mysqli_set_charset($link,"utf-8");
mysqli_select_db($link, "user"); 

$sql1 = "SELECT * FROM user";
$res1 = mysqli_query($link,$sql1);
$row1 =  mysqli_num_rows($res1);

$sql2 = "INSERT INTO user(username,password) VALUES('$username','$password');";
$res2 = mysqli_query($link,$sql2);

$sql3 = "SELECT * FROM user where username = '$username'";
$res3 = mysqli_query($link,$sql3);
$row3 = mysqli_num_rows($res3);

//printf($row3);
if (!$row3 || !$row1) {
    printf("Error: %s\n", mysqli_error($link));
    
}

if($row3>1){
    $responddata['code'] = 1;
    $responddata['message'] = "用户名重复";
    
    $sql4 = "CREATE TABLE user_temp LIKE user;
    INSERT INTO user_temp
    SELECT * FROM user WHERE id in(
    select min(id) FROM user group by username);
    DROP TABLE user;
    ALTER TABLE user_temp RENAME TO user;";

    mysqli_multi_query($link,$sql4);

    echo json_encode($responddata);
    //echo "用户名重复";
    exit;
}

/*
$sql1 = "CREATE TABLE users (
    number INT(32) PRIMARY KEY,
    name VARCHAR(32)
)";
if ($con->query($sql1) == true) {
    $responddata['code'] = 6;
    $responddata['message'] = "数据表 table1 创建成功！<br>";
    echo json_encode($responddata);
    
} else {
    $responddata['code'] = 6;
    $responddata['message'] = "创建失败！<br>";
    echo json_encode($responddata);
    exit;
}

*/


if(!$res2){
    $responddata['code'] = 2;
    $responddata['message'] = "注册失败";
    echo json_encode($responddata);
    //echo "注册失败";
    exit;
}else{
    $responddata['code'] = 3;
    $responddata['message'] = "注册成功";
    echo json_encode($responddata);
    //echo "注册成功！";
}

mysqli_close($link);

?>
