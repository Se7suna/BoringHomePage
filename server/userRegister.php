<?php
/**
 * 用户注册
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");

if(!isset($_GET['userName'])){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 请输入用户名"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

$userAvatar = '';
$userName = $_GET['userName'];
$userPass = '';

if(isset($_GET['userAvatar'])){
  $userAvatar = $_GET['userAvatar'];
}
if(isset($_GET['userPass'])){
  $userPass = $_GET['userPass'];
}

// 查询用户名是否存在
$check_query_user = mysqli_query($conn , "select * from user where userName='$userName' limit 1");
if (!$check_query_user) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}
if(mysqli_fetch_array($check_query_user, MYSQLI_ASSOC)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：用户名 ' . $userName . ' 已存在。'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

// 添加用户
$time = time();
$sql = "INSERT INTO `user` (userId,userAvatar,userName,userPass) VALUES ('$time', '$userAvatar', '$userName','$userPass')";
if(mysqli_query($conn, $sql)){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
      "userId"=> $time , // 用户id
      "userAvatar"=> $userAvatar ,// 用户头像
      "userName"=> $userName,   // 用户名
      "userPass"=> $userPass // 密码
    ),
    'resInfo'=>'成功: 用户注册成功！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
} else {
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：用户名注册失败, 请稍后重试或联系管理员!'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}