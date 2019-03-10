<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/3/31
 * FileExplain:
 */
header("Content-Type:text/html;charset=UTF-8");
$book = $_GET['book'];
$booksinfo = explode('_',$book,3);
$bookName = urldecode($booksinfo[0]);
$bookName .='.txt';
$jof = $booksinfo[2];
$bookid = $booksinfo[1];
$jf = '';
if($jof == 0){
	$jf = 'jianti';
}else{
	$jf = 'fanti';
}
$fileDir = '../bookfile/allbook/'.$jf.'/'.$bookid.'.txt';
if(! file_exists($fileDir)){
	echo '404';
	exit();
}else{
	$file = fopen($fileDir,'r');
	Header("Content-type: application/octet-stream;charset=UTF-8");
	Header("Accept-Ranges: bytes");
	Header ( "Accept-Length: ".filesize($fileDir));
	Header ( "Content-Disposition: attachment; filename=".$bookName );
	echo fread($file,filesize($fileDir));
	fclose($file);
	exit();
}

?>