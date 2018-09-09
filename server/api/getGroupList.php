<?php
/**
 * 用户根据 用户id 获得 他所参加的群组列表
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
    'resInfo'=>"错误: 请登录!"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

// 根据 userId 查询 userId 相关的所有 group (查userofgroup表, 应该新建群的时候, 会把群主相关信息加到 userofgroup 表和 group 表中)
// 包括他身份为 群主 和 普通用户 的所有群
$userId = $_GET['userId'];
$dataList = [];
$sql = "select * from userofgroup where userId='$userId'";
$check_query = mysqli_query($conn, $sql);
while($obj = mysqli_fetch_object($check_query))
{
  $dataList[] = $obj;
}
if(mysqli_query($conn, $sql)){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
      'dataList' => $dataList
    ),
    'resInfo'=>'成功: 获取数据成功!'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}else{
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：数据获取失败, 请稍后重试或联系管理员!'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}