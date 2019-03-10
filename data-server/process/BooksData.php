<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/2/27
 * FileExplain:查询书籍，将查询结果转为Json发送给api
 */
header("Content-Type:text/html;charset=UTF-8");
require('../class/Books.php');

@$page = $_GET['page'];
@$query = $_GET['query'];
@$type = $_GET['type'];
@$jof = $_GET['jof'];
@$sex = $_GET['sex'];
$jsonData = '';
switch($type){
	case 'all':
		$jsonData = getDataForAll($jof,$page);
		break;
	case 'id':
		$jsonData = getDataForId($jof,$query);
		break;
	case 'category':
		$jsonData = getDataForCategory($jof,$page,$query,$sex);
		break;
	case 'query':
		$jsonData = getDataForQuery($jof,$page,$query);
		break;
	case 'tag':
		$jsonData = getDataForTag($jof,$page,$query);
		break;
}
echo $jsonData;



//查询所有书籍
function getDataForAll($jof,$page){
	$book = Books::getInstance();
	$count_normal = $book->selectCountForAll(0,$jof);
	$count_fb = $book->selectCountForAll(1,$jof);
	$count = $count_fb+$count_normal;
	$forbiddens = $book->selectForAll(1,$jof,($page-1)*30,30);
	$normals = null;
	if($page>=$count_fb/30){
		$limit = getNorCount($page,$count_fb);
		$normals = $book->selectForAll(0,$jof,$limit['start'],$limit['end']);
	}
	return dataToJson($forbiddens,$normals,$count);

}

//根据ID查询
function getDataForId($jof,$bookId){
	$book = Books::getInstance();
	$forbiddens = $book->selectForId(1,$jof,$bookId,0,1);
	$normals = null;
	if(count($forbiddens)<1){
		$normals = $book->selectForId(0,$jof,$bookId,0,1);
		return dataToJson(null,$normals,count($normals));
	}
	return dataToJson($forbiddens,null,count($forbiddens));
}

//根据query查询
function getDataForQuery($jof,$page,$query){
	$book = Books::getInstance();
	$count_normal = $book->selectCountForQuery(0,$jof,$query);
	$count_fb = $book->selectCountForQuery(1,$jof,$query);
	$count = $count_fb+$count_normal;
	$forbiddens = $book->selectForQuery(1,$jof,$query,($page-1)*30,30);
	$normals = null;
	if($page>=$count_fb/30){
		$limit = getNorCount($page,$count_fb);
		$normals = $book->selectForQuery(0,$jof,$query,$limit['start'],$limit['end']);
	}
	return dataToJson($forbiddens,$normals,$count);
}
//根据分类查询
function getDataForCategory($jof,$page,$category,$sex){
	$book = Books::getInstance();
	$count_normal = $book->selectCountForCategory(0,$jof,$category,$sex);
	$count_fb = $book->selectCountForCategory(1,$jof,$category,$sex);
	$count = $count_fb+$count_normal;
	$forbiddens = $book->selectForCategory(1,$jof,$category,$sex,($page-1)*30,30);
	$normals = null;
	if($page>=$count_fb/30){
		$limit = getNorCount($page,$count_fb);
		$normals = $book->selectForCategory(0,$jof,$category,$sex,$limit['start'],$limit['end']);
	}
	return dataToJson($forbiddens,$normals,$count);
}
//根据标签查询
function getDataForTag($jof,$page,$tag){
	$book = Books::getInstance();
	$count_normal = $book->selectCountForTag(0,$jof,$tag);
	$count_fb = $book->selectCountForTag(1,$jof,$tag);
	$count = $count_fb+$count_normal;
	$forbiddens = $book->selectForTags(1,$jof,$tag,($page-1)*30,30);
	$normals = null;
	if($page>=$count_fb/30){
		$limit = getNorCount($page,$count_fb);
		$normals = $book->selectForTags(0,$jof,$tag,$limit['start'],$limit['end']);
	}
	return dataToJson($forbiddens,$normals,$count);
}

//根据forbidden数量生成当前页normal的Limit
function getNorCount($page,$fbCount){
	$limit = array();
	$fbpage = floor($fbCount/30);
	$fbyu = floor($fbCount%30);
	if($page<=$fbpage){
	}else{
		if($page==$fbpage+1){
			$limit['start'] = 0;
			$limit['end'] = 30-$fbyu;
		}else{
			$limit['start'] = ($page-$fbpage-1)*30-$fbyu;
//			$limit['end'] = ($page-$fbpage)*30-$fbyu;
			$limit['end'] = 30;
		}
	}
	return $limit;
}
//将结果转为json
function dataToJson($forbiddens,$normals,$count){

	$jsonstr = "{ \"count\":\"{$count}\",\"forbidden\":";
	if(!empty($forbiddens)){
		$jsonstr.=json_encode($forbiddens,JSON_UNESCAPED_UNICODE).",\"normal\":";
	}else{
		$jsonstr.="0,\"normal\":";
	}
	if(!empty($normals)){
		$jsonstr.=json_encode($normals,JSON_UNESCAPED_UNICODE)."}";
	}else{
		$jsonstr.='"0"}';
	}
	return $jsonstr;
}
exit;
?>