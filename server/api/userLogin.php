<?php
/**
 * 用户登录
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0 
 * 
 * 3 请输入用户名
 * 2 用户不存在
 * 1 登录成功
 * 0 服务器异常
 */
require("./connectMySQL.php");
$json_data = json_decode(file_get_contents('php://input'));

if(!isset($json_data->userName)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"3" // 错误: 请输入用户名
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

$userName = $json_data->userName;
$userPass = '';

if(isset($json_data->userPass)){
  $userPass = $json_data->userPass;
}

// 查询用户名是否存在
$check_query_user = mysqli_query($conn , "select * from user where userName='$userName'");
$check_query_pass = mysqli_query($conn , "select * from user where userPass='$userPass' and userName='$userName' limit 1");
if (!$check_query_user) {
  // printf("Error: %s\n", mysqli_error($conn));
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'0' // 服务器异常
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}
if(!mysqli_fetch_array($check_query_user, MYSQLI_ASSOC)){
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'2' // 错误：用户名 ' . $userName . ' 不存在。
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

// 密码与账户是否匹配 
$rows = mysqli_fetch_assoc($check_query_pass);
if($rows){
  $aUserOfGroup = fnGetUserOfGroup($rows['userId']);
  $linkOfUser = fnGetLinkOfGroup($aUserOfGroup); // 用户能查看此群组中所有的分享链接
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
      'userId' => $rows['userId'],
      'userAvatar'=> $rows['userAvatar'],
      'userName' => $rows['userName'],
      'linkOfUser' => $linkOfUser
    ),
    'resInfo'=>'1' // 成功：用户名 ' . $userName . ' 登录成功。'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}else{
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'4' // '错误：用户名 ' . $userName . ' 与登录密码不匹配。'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}


/**
 * 根据 userId 获得 GroupList */
function fnGetUserOfGroup($userId)
{
  global $conn;
  $result = array();
  $sql = "select groupId from `userofgroup` where userId = '$userId'";
  $retval = mysqli_query( $conn, $sql );
  while($row = mysqli_fetch_array($retval, MYSQLI_ASSOC))
  {
    $result[] = $row['groupId']; 
  }
  return $result;
}

/**
 * 根据 群组id们(数组形式) 获得 分享链接 */
function fnGetLinkOfGroup($aUserOfGroup)
{
  global $conn;
  $result = array();
  for($x=0;$x<count($aUserOfGroup);$x++)
  {
    $sql = "select * from `linkofgroup` where groupId = '$aUserOfGroup[$x]' and shareLinkState = 1";
    $retval = mysqli_query( $conn, $sql );
    while($row = mysqli_fetch_object($retval))
    {
      $result[] = $row; 
    }
  }
  return $result;
}