<?php
/**
 * 用户创建群组
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");

if(!isset($_GET['userId'])){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺失参数"
  ), JSON_UNESCAPED_UNICODE);
  mysqli_close($conn);
  exit;
}

$userId = $_GET['userId'];
$hash = md5(uniqid(microtime(true),true));
$sql = "INSERT INTO user (id,userId,userAvatar,userName,userPass)VALUES('$time', '$time', '$userAvatar', '$userName','$userPass')";
if(true){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=> array(
      'hash' => $hash,
      'userId' => $userId
    ),
    'resInfo'=>'成功: 创建成功!'
  ), JSON_UNESCAPED_UNICODE);
  mysqli_close($conn);
  exit;
}else{
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：群组创建失败, 请稍后重试或联系管理员!'
  ), JSON_UNESCAPED_UNICODE);
  mysqli_close($conn);
  exit;
}