<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/3/3
 * FileExplain:向前段提供书籍内容以及所请求的书籍章节数:当type=count时返回章节数,当type=content时返回书籍内容
 */
header("Content-Type:text/html;charset=UTF-8");
$bookid = $_GET['bookid'];
$page = $_GET['page'];
$jof = $_GET['jof'];
$type = $_GET['type'];
$dir = '../bookfile/';


if($type == 'count'){
	echo getSecCount($bookid,$jof);
}else if($type == 'content'){
	echo getContent($bookid,$jof,$page);
}

//获取书籍的章节数量
function getSecCount($bookid,$jof){
	$bookdir = "../bookfile/books_";
	if($jof==0){
		$bookdir.='jianti/';
	}else{
		$bookdir.='fanti/';
	}
	if(!file_exists($bookdir)){
		return 0;
	}
	$bookdir.="{$bookid}/";
	$secArr = scandir($bookdir);
	return count($secArr)-2;
}


//获取书籍内容
function getContent($bookid,$jof,$page){
	$secPath = "../bookfile/books_";
	if($jof==0){
		$secPath.='jianti/';
	}else{
		$secPath.='fanti/';
	}
	if($page>100){

	}else if($page>10){
		$page = '0'.$page;
	}else if($page==10){
		$page = '0'.$page;
	}else{
		$page = '00'.$page;
	}
	$secPath.="{$bookid}/{$bookid}_{$page}.txt";
	if(!file_exists($secPath)){
		return 0;
	}
	$content = file_get_contents($secPath);
	if(is_null($content)){
		return 0;
	}
	//进行base64编码,
	$content = base64_encode($content);
	return $content;
}
exit;
?>