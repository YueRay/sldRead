<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/2/29
 * FileExplain:处理页面发送的请求
 */
header("Content-Type:text/html;charset=UTF-8");
require('Functions.php');
$type = $_GET['type'];
$query = $_GET['query'];
@$page = $_GET['page'];
@$jof = $_GET['jof'];
@$sex = $_GET['sex'];

$data = '';
switch($type){
	case 'category':
	case 'tag':
	case 'all':
		$data = getData($type,$jof,$query,$page,$sex);
		break;
	case 'query':
	case 'id':
		$data = getDataForServers($type,$jof,$query,$page,$sex);
		break;
}
echo $data;

//当请求category,tag,all，先从本地缓存获取数据，本地没有再从后端获取
function getData($type,$jof,$query,$page,$sex){
	$data = getDataForFile($type,$jof,$query,$page,$sex);
	if($data==0){
		$data = saveDataToFile($type,$jof,$query,$page,$sex);
	}
	return $data;
}

//当请求query，id,直接从后端获取数据
function getDataForServers($type,$jof,$query,$page,$sex){
	require_once('../config/diconfig.php');
	$url = $api_config['booksdata']."?type={$type}&jof={$jof}&page={$page}&query={$query}&sex={$sex}";
	$data = file_get_contents($url);
	return $data;
}
exit;
?>