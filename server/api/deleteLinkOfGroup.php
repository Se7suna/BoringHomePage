<?php
/**
 * 用户根据 链接id 在群组中删除链接
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");
$json_data = json_decode(file_get_contents('php://input'));
// $json_data = array_to_object($_POST); // 本地测试用

if(!isset($json_data->id)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 请选择链接 !"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}
if(!isset($json_data->userId)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺少参数 userId !"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

$id = $json_data->id;
$userId = $json_data->userId;

// 判断是否具有权限
$sql1 = "SELECT * FROM linkofgroup WHERE id = '$id' and groupLord = '$userId'";
$rows = mysqli_fetch_assoc(mysqli_query($conn, $sql1));
if(!$rows){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
    ),
    'resInfo'=>'错误: 用户权限不匹配！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

// 删除此链接
$sql2 = "DELETE FROM linkofgroup WHERE id = '$id' and groupLord = '$userId'";
if(mysqli_query($conn, $sql2)){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
    ),
    'resInfo'=>'成功: 链接删除成功！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
} else {
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：链接删除失败, 请稍后重试或联系管理员！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}