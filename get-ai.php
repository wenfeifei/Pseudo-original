<?php
/*
不念博客https://www.bunian.cn/ai/
没有版权 任意分发
*/

header('Access-Control-Allow-Origin:*');
header('Content-type:text/html;charset=utf-8');
function zh_en($text){
	$entext = urlencode($text);
	$url = 'http://translate.google.cn/translate_a/single?client=gtx&dt=t&ie=UTF-8&oe=UTF-8&sl=zh-CN&tl=EN&q='.$entext;
	set_time_limit(0);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS,20);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 40);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
        $result = json_decode($result);
	if(!empty($result)){
	foreach($result[0] as $k){
		$v[] = $k[0];
	}
	return implode(" ", $v);
	}
}
function en_zh($text){
	$entext = urlencode($text);
	$url = 'http://translate.google.cn/translate_a/single?client=gtx&dt=t&ie=UTF-8&oe=UTF-8&sl=EN&tl=zh-CN&q='.$entext;
	set_time_limit(0);
	$ch = curl_init();
	curl_setopt($ch, CURLOPT_USERAGENT, $_SERVER['HTTP_USER_AGENT']);
	curl_setopt($ch, CURLOPT_HEADER, false);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
	curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
	curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
	curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
	curl_setopt($ch, CURLOPT_MAXREDIRS,20);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 40);
	curl_setopt($ch, CURLOPT_URL, $url);
	$result = curl_exec($ch);
	curl_close($ch);
        $result = json_decode($result);
	if(!empty($result)){
	foreach($result[0] as $k){
		$v[] = $k[0];
	}
	return implode(" ", $v);
	}
}
function mbStrSplit ($string, $len=1) {
  $start = 0;
  $strlen = mb_strlen($string);
  while ($strlen) {
    $array[] = mb_substr($string,$start,$len,"utf8");
    $string = mb_substr($string, $len, $strlen,"utf8");
    $strlen = mb_strlen($string);
  }
  return $array;
}

$infocount=mb_strlen($_POST['info'], 'UTF-8');
if($_POST and $infocount<2000){

$r = mbStrSplit($_POST['info'], 1000);
$arr=count($r);

 for($i=0;$i<$arr;$i++){
    echo en_zh(zh_en($r[$i]));
 }
//echo "\n 接口访问频繁。请24h后再试";
}else{
echo '请输入需要伪原创的文章，并且文章内容不可以超过2000个字符';
}
