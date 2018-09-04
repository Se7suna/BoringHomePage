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
  mysqli_close($conn);
  return $array;
}

if(isset($_GET['pageSize'])){
  $pageSize = $_GET['pageSize'];
}
if(isset($_GET['pageNum'])){
  $pageNum = $_GET['pageNum'];
}

echo json_encode(array(
  'resCode'=>0,
  'resData'=>newPaging($pageNum, $pageSize),
  'resInfo'=>'成功: 获得数据!'
), JSON_UNESCAPED_UNICODE);
// mysqli_close($conn);
exit;
// 查询一个背景图


// {
//   resCode: 1, 
//   resData: {
//     dataSize : 10,
//     dataNum : 1,
//     dataTotal : 100,
//     dataList :[{
    // bgSrc: 'https://rabc2.iteye.com/i/media/v1/0f000nTw6TryU7IXpq-Cqs.jpg',
    // bgName: '图片名,图片标题,可以用,可以不用',
    // bgDesc: '图片说明,图片详情,图片介绍,这是某某国家某某地区, 很丑的一个公考拉',
    // bgStar: 1,}]
//   },
//   resInfo:'获取数据成功'
// }