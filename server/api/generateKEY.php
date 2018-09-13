<?php
/**
 * 用户创建群组
 * TODO 本文件是否需要改名为 : createGroup
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");
$json_data = json_decode(file_get_contents('php://input'));

if(!isset($json_data->userId)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺失参数 userId"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

$userId = $json_data->userId;
$groupName = '';
$hash = md5(uniqid(microtime(true),true));

if(isset($json_data->groupName)){
  $groupName = $json_data->groupName;
}

// 查询用户名是否存在
$check_query_user = mysqli_query($conn , "select * from user where userId='$userId' limit 1");
if (!$check_query_user) {
  // printf("Error: %s\n", mysqli_error($conn));
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误: 服务器异常, 请稍后重试或联系管理员!' // 服务器异常
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}
if(!mysqli_fetch_array($check_query_user, MYSQLI_ASSOC)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：不存在此用户。'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

// 创建群组
$sql = "INSERT INTO `group` (groupId ,groupName, groupLord) VALUES ('$hash', '$groupName', '$userId')"; // 添加到 group 列表
$sql2 = "INSERT INTO `userofgroup` (groupId, groupName, userId, groupLord) VALUES ('$hash', '$groupName', '$userId', '$userId')"; // 添加到 userofgroup 列表
if(mysqli_query($conn, $sql) && mysqli_query($conn, $sql2)){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=> array(
      'hash' => $hash,
      'groupId' => $hash,
      'groupLord' => $userId,
      'groupName' => $groupName,
    ),
    'resInfo'=>'成功: 创建成功!'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}else{
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：群组创建失败, 请稍后重试或联系管理员!'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}