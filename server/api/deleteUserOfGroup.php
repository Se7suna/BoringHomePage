<?php
/**
 * 用户(/群主) 根据 用户id 与 群组id 在群组中删除 自己/组员
 * 用户退出群组 -> 用户根据群组id 与 自身的id , 调用此接口, 则删除之~
 * 群组开除组员 -> 群主根据群组id 与 用户id, 调用此接口, 则删除之~
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");
$json_data = json_decode(file_get_contents('php://input'));
// $json_data = array_to_object($_POST); // 本地测试用

if(!isset($json_data->groupId)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 请指定群组 !"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}
if(!isset($json_data->userId)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 请指定用户 !"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

$groupId = $json_data->groupId;
$userId = $json_data->userId;

// 判断是否存在
$sql1 = "SELECT * FROM userofgroup WHERE userId = '$userId' and groupId = '$groupId'";
$rows = mysqli_fetch_assoc(mysqli_query($conn, $sql1));
if(!$rows){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
    ),
    'resInfo'=>'错误: 用户不在该群组！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

// 删除此用户
$sql2 = "DELETE FROM userofgroup WHERE userId = '$userId' and groupId = '$groupId'";
if(mysqli_query($conn, $sql2)){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
    ),
    'resInfo'=>'成功: 用户删除成功！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
} else {
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：用户删除失败, 请稍后重试或联系管理员！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}