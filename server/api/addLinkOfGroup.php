<?php
/**
 * 用户根据 群组id 与 用户id 与 链接地址 在群组中新增链接
 * @authors qgp/Plq (773561801@qq.com)
 * @date    2018-08-31 11:59:28
 * @version 1.0.0
 */
require("./connectMySQL.php");
require('./phpquery-master/phpQuery/phpQuery.php');

$json_data = json_decode(file_get_contents('php://input'));

if(!isset($json_data->userId)){ // 用户
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺少参数 userId!"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

if(!isset($json_data->groupId)){ // 群组
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺少参数 groupId!"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

if(!isset($json_data->shareLinkSrc)){ // 分享链接
  echo json_encode(array(
    'resCode'=>0,
    'resData'=>array(
      
    ),
    'resInfo'=>"错误: 缺少参数 shareLinkSrc!"
  ),JSON_UNESCAPED_UNICODE );
  mysqli_close($conn);
  exit;
}

$userName = ''; // 分享者的 name
if(isset($json_data->userName)){
  $userName = $json_data->userName;
}

$shareLinkState = 0; // 分享的链接状态
$groupId = $json_data->groupId;
$userId = $json_data->userId;
$shareLinkSrc = $json_data->shareLinkSrc;

// 通过爬虫 获得链接的图标地址与 链接title
$content = get_fcontent($shareLinkSrc);
phpQuery::newDocumentHTML($content);
$pageTitle = pq('title')->html();
$pageFavicon = favicon_file($shareLinkSrc);

$shareLinkName = $pageTitle; // 分享的链接名
if(isset($json_data->shareLinkName)){
  $shareLinkName = $json_data->shareLinkName;
}

$shareLinkIcoScr = $pageFavicon; // 分享链接的图标地址
if(isset($json_data->shareLinkIcoScr)){
  $shareLinkIcoScr = $json_data->shareLinkIcoScr;
}

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



/**
 * 添加 USERAGENT , 模拟真实浏览器访问
 * */ 
function get_fcontent($url,  $timeout = 5 ) {
  $url = str_replace( "&amp;", "&", urldecode(trim($url)) );
  $cookie = tempnam ("/tmp", "CURLCOOKIE");
  $ch = curl_init();
  curl_setopt( $ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 5.1; rv:1.7.3) Gecko/20041001 Firefox/0.10.1" );
  curl_setopt( $ch, CURLOPT_URL, $url);//需要获取的URL地址，也可以在 curl_init()函数中设置。
  curl_setopt( $ch, CURLOPT_COOKIEJAR, $cookie );//连接结束后保存cookie信息的文件。
  curl_setopt( $ch, CURLOPT_FOLLOWLOCATION, true );//启用时会将服务器服务器返回的"Location: "放在header中递归的返回给服务器，使用CURLOPT_MAXREDIRS可以限定递归返回的数量。
  curl_setopt( $ch, CURLOPT_ENCODING, "" );//HTTP请求头中"Accept-Encoding: "的值。支持的编码有"identity"，"deflate"和"gzip"。如果为空字符串""，请求头会发送所有支持的编码类型。在cURL 7.10中被加入。
  curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );//将 curl_exec()获取的信息以文件流的形式返回，而不是直接输出。
  curl_setopt( $ch, CURLOPT_AUTOREFERER, true );//当根据Location:重定向时，自动设置header中的Referer:信息。
  //禁用后cURL将终止从服务端进行验证。使用CURLOPT_CAINFO选项设置证书使用CURLOPT_CAPATH选项设置证书目录 如果CURLOPT_SSL_VERIFYPEER(默认值为2)被启用，CURLOPT_SSL_VERIFYHOST需要被设置成TRUE否则设置为FALSE。自cURL 7.10开始默认为TRUE。从cURL 7.10开始默认绑定安装。
  curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, false );   //  # required for https urls, 在发起连接前等待的时间，如果设置为0，则无限等待。
  curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, $timeout );
  curl_setopt( $ch, CURLOPT_TIMEOUT, $timeout ); // 设置cURL允许执行的最长秒数。	
  curl_setopt( $ch, CURLOPT_MAXREDIRS, 10 ); //指定最多的HTTP重定向的数量，这个选项是和CURLOPT_FOLLOWLOCATION一起使用的。
  $content = curl_exec( $ch );
  curl_close ( $ch );
  return $content;
}

/**
 * 获取友链favicon站标，php代码 */
function favicon_file($url){
  return 'http://api.byi.pw/favicon/?url=' . $url;
}
