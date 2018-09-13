<?php
/**
 * 连接 数据库
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
header('Content-type:application/json;charset=utf-8');     // 这句是重点，它告诉接收数据的对象此页面输出的是json数据；

header('Access-Control-Allow-Origin:*'); // 跨域
// $_SERVER['REQUEST_METHOD'] === "OPTIONS" // 判断请求的 methods
// header('Access-Control-Allow-Methods:GET, POST, PUT, OPTIONS'); // 请求方式, 如 get post options 等
// header("Access-Control-Allow-Headers:*");
// header("Access-Control-Allow-Credentials: true");
// header("Access-Control-Max-Age: 1728000"); // 用来指定本次预检请求的有效期，单位为秒, 这里是20天

// $servername = "localhost";
// $username = "root";
// $password = ""; // 本地 服务器

$servername = "47.106.86.139";
$username = "root";
$password = "168168"; // 147 服务器

// 创建数据库连接
$conn = new mysqli($servername, $username, $password);
// 选择表
mysqli_select_db( $conn, 'boringhomepage' );
//字符转换，读库
mysqli_query($conn ,"set character set 'utf8'");
//写库
mysqli_query($conn ,"set names 'utf8'");
 
// 检测连接
if ($conn->connect_error) {
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"连接失败: " . $conn->connect_error
  ),JSON_UNESCAPED_UNICODE );
} 




/**
 * 数组 转 对象
 *
 * @param array $arr 数组
 * @return object
 */
function array_to_object($arr) {
  if (gettype($arr) != 'array') {
      return;
  }
  foreach ($arr as $k => $v) {
      if (gettype($v) == 'array' || getType($v) == 'object') {
          $arr[$k] = (object)array_to_object($v);
      }
  }
  return (object)$arr;
}