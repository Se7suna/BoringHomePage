<?php
/**
 * 用户登录
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

$userName = $_GET['userName'];
$userPass = '';

if(isset($_GET['userPass'])){
  $userPass = $_GET['userPass'];
}

// 查询用户名是否存在
$check_query_user = mysqli_query($conn , "select * from user where userName='$userName'");
$check_query_pass = mysqli_query($conn , "select * from user where userPass='$userPass' and userName='$userName' limit 1");
if (!$check_query_user) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}
if(!mysqli_fetch_array($check_query_user, MYSQLI_ASSOC)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：用户名 ' . $userName . ' 不存在。'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

  
// 密码与账户是否匹配 
$rows = mysqli_fetch_assoc($check_query_pass);
if($rows){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
      'userId' => $rows['userId'],
      'userAvatar'=> $rows['userAvatar'],
      'userName' => $rows['userName']
    ),
    'resInfo'=>'成功：用户名 ' . $userName . ' 登录成功。'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}else{
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：用户名 ' . $userName . ' 与登录密码不匹配。'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}