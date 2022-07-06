<?php
use PhpMyAdmin\Scripts;

header('content-type:text/html;charset="utf-8";Access-Control-Allow-Origin: *');

$username = $_POST['username'];
$password = $_POST['password'];

if(empty($username)  || empty($password) ){
    exit;
}

//对密码加密
$password = md5(md5($password."aaa")."bbb");

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


mysqli_set_charset($link,"utf8");
mysqli_select_db($link, "user"); 

// $sql = "SELECT * FROM users WHERE username='{$username}'";
// $res = mysql_query($sql);
// $row = mysql_fetch_assoc($res);

// if($row){
//     $responddata['code'] = 1;
//     $responddata['message'] = "用户名重复";
//     echo json_encode($responddata);
//     exit;
// }

$sql1 = "SELECT * FROM user WHERE username='$username' AND password = '$password'";
$res1 = mysqli_query($link,$sql1);
error_reporting(1);
$row1 = mysqli_num_rows($res1);

if(!$row1){
    $responddata['code'] = 1;
    $responddata['message'] = "用户名或密码错误";
    echo json_encode($responddata);
    //$a = "用户名或密码错误";
    //echo $a;
    exit;
}else{
    $responddata['code'] = 2;
    $responddata['message'] = "登录成功";
    echo json_encode($responddata);
    //echo "登录成功!";

    
}

mysqli_close($link);



?>