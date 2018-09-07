<?php
/**
 * 用户根据 群组id 与 用户id 与 链接地址 在群组中新增链接
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");

if(!isset($_GET['id'])){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 请选择链接 !"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}
if(!isset($_GET['shareLinkState'])){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺少参数 shareLinkState !"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}
$id = $_GET['id'];
$shareLinkState = $_GET['shareLinkState']; // 状态,0表示未审核(默认未审核), 1表示审核通过
$sql = "UPDATE linkofgroup SET shareLinkState='$shareLinkState' where id = '$id'";

if(mysqli_query($conn, $sql)){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
    ),
    'resInfo'=>'成功: 状态更新成功！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
} else {
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：状态更新失败！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}