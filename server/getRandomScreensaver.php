<?php
/**
 * 获得随机background
 * 获得指定列到指定列的数据 - 分页
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");

$pageSize = 10;
$pageNum = 1;
$pageTotal = 0; // 总页数

/**
 * 分页的函数 */
function newPaging($pageNum, $pageSize)
{
  global $conn;
  $array = array();
  $sql = "select * from background limit " . (($pageNum - 1) * $pageSize) . "," . $pageSize;
  $check_query = mysqli_query($conn , $sql);
  if (!$check_query) {
    printf("Error: %s\n", mysqli_error($conn));
    exit();
  }
  while ($obj = mysqli_fetch_object($check_query)) {
    $array[] = $obj;
  }
  return $array;
}

if(isset($_GET['pageSize'])){
  $pageSize = $_GET['pageSize'];
}
if(isset($_GET['pageNum'])){
  $pageNum = $_GET['pageNum'];
}

//显示出总页数
$sql2 = "select count(*) num from background";  // 返回表的纪录数
$check_query2 = mysqli_query($conn, $sql2);
$obj = mysqli_fetch_object($check_query2);
$pageTotal = $obj->num;

$result = newPaging($pageNum, $pageSize);
if(count($result)){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
      'dataSize' => $pageSize,
      'dataNum' => $pageNum,
      'dataTotal' => $pageTotal,
      'dataList' => newPaging($pageNum, $pageSize)
    ),
    'resInfo'=>'成功: 获得数据!'
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