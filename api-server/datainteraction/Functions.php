<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/2/25
 * FileExplain:定义公共方法
 */
header("Content-Type:text/html;charset=UTF-8");

//发送post请求
function send_post($url, $post_data)
{
	$postdata = http_build_query($post_data);
	$options = array(
		'http' => array(
			'method' => 'POST',
			'header' => 'Content-type:application/x-www-form-urlencoded',
			'content' => $postdata,
			'timeout' => 15 * 60 // 超时时间（单位:s）
		)
	);
	$context = stream_context_create($options);
	$result = file_get_contents($url, false, $context);

	return $result;
}

//读取本地缓存文件,将query进行url编码，防止乱码
function getDataForFile($type,$jof,$query,$page,$sex){
	$query = urlencode($query);
	$filepath = "../cachefiles/{$type}/{$query}_{$jof}_{$sex}_{$page}.txt";
	//echo '<br>Functions->getDataFroFile'.$filepath.'<br>';
	if(!file_exists($filepath)){
		return 0;
	}
	$data = file_get_contents($filepath);
	if(is_null($data)){
		return 0;
	}
	return $data;
}

//请求后端数据，缓存json到本地文件，将url编码，防止乱码
function saveDataToFile($type,$jof,$query,$page,$sex){
	$query = urlencode($query);
	require_once('../config/diconfig.php');
	$url = $api_config['booksdata']."?type={$type}&jof={$jof}&page={$page}&query={$query}&sex={$sex}";
	$data = file_get_contents($url);
	if(is_null($data)){
		return 0;
	}
	$filepath = "../cachefiles/{$type}/{$query}_{$jof}_{$sex}_{$page}.txt";
	if(file_exists($filepath)){
		unlink($filepath);
	}
	$fcache = fopen($filepath,"w");
	fwrite($fcache,$data);
	fclose($fcache);
	return $data;
}
?>