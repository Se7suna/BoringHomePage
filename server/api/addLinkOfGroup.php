<?php
/**
 * 用户根据 群组id 与 用户id 与 链接地址 在群组中新增链接
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");

if(!isset($_POST['userId'])){ // 用户
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺少参数 userId!"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

if(!isset($_POST['groupId'])){ // 群组
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺少参数 groupId!"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

if(!isset($_POST['shareLinkSrc'])){ // 分享链接
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺少参数 shareLinkSrc!"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

$shareLinkName = ''; // 分享的链接名
if(isset($_POST['shareLinkName'])){
  $shareLinkName = $_POST['shareLinkName'];
}

$userName = ''; // 分享者的 name
if(isset($_POST['userName'])){
  $userName = $_POST['userName'];
}

$shareLinkState = 0; // 分享的链接状态
$shareLinkIcoScr = ''; // 分享链接的图标地址
$groupId = $_POST['groupId'];
$userId = $_POST['userId'];
$shareLinkSrc = $_POST['shareLinkSrc'];

$sql = "INSERT INTO `linkofgroup` 
(groupId,userId,shareLinkSrc,userName,shareLinkIcoScr,shareLinkState,shareLinkName) 
VALUES 
('$groupId', '$userId', '$shareLinkSrc', '$userName', '$shareLinkIcoScr', '$shareLinkState', '$shareLinkName')";

if(mysqli_query($conn, $sql)){
  echo json_encode(array(
    'resCode'=>1,
    'resData'=>array(
      'groupId' => $groupId,
      'userId' => $userId,
      'shareLinkSrc' => $shareLinkSrc,
      'userName' => $userName,
      'shareLinkIcoScr' => $shareLinkIcoScr,
      'shareLinkState' => $shareLinkState,
      'shareLinkName' => $shareLinkName
    ),
    'resInfo'=>'成功: 链接提交成功, 等待审核！'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
} else {
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>'错误：链接提交失败, 请稍后重试或联系管理员!'
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}