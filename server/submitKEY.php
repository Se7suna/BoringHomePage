<?php
/**
 * 用户加入群组
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
    'resInfo'=>"错误: 缺失参数 userId"
  ), JSON_UNESCAPED_UNICODE);
  mysqli_close($conn);
  exit;
}

if(!isset($_GET['hash'])){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺失参数 hash"
  ), JSON_UNESCAPED_UNICODE);
  mysqli_close($conn);
  exit;
}

$userId = $_GET['userId'];
$groupId = $_GET['hash'];

// 查询群组是否存在
$check_query_group = mysqli_query($conn , "select * from `group` where groupId='$groupId' limit 1");
if (!$check_query_group) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}
if(!mysqli_fetch_array($check_query_group, MYSQLI_ASSOC)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：不存在此群组。'
  ), JSON_UNESCAPED_UNICODE);
  mysqli_close($conn);
  exit;
}

// 查询是否已在组中
$check_query_group2 = mysqli_query($conn , "select * from `userOfGroup` where userId='$userId' and groupId='$groupId'");
if (!$check_query_group2) {
  printf("Error: %s\n", mysqli_error($conn));
  exit();
}
if(mysqli_fetch_array($check_query_group2)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'提示: 该用户已在组中!'
  ), JSON_UNESCAPED_UNICODE);
  mysqli_close($conn);
  exit;
}

// 加入群组
$sql = "INSERT INTO `userOfGroup` (userId,groupId) VALUES ('$userId', '$groupId')";
if(mysqli_query($conn, $sql)){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=> array(
      'userId' => $userId,
      'groupId' => $groupId,
    ),
    'resInfo'=>'成功: 加入成功!'
  ), JSON_UNESCAPED_UNICODE);
  mysqli_close($conn);
  exit;
}else{
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：加入失败, 请稍后重试或联系管理员!'
  ), JSON_UNESCAPED_UNICODE);
  mysqli_close($conn);
  exit;
}