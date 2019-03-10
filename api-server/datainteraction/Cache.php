<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/3/4
 * FileExplain:linux系统crontab命令，时间段内自动执行
 */
$cache_all = '../cachefiles/all/';
$cache_category = '../cachefiles/tag';
$cache_tag = '../cachefiles/category/';

cleanCache($cache_all);

function cleanCache($cachepath){

	$caches = opendir($cachepath);
	while($cacheFile = readdir($caches)){
		if($cacheFile != '.' && $cacheFile != '..'){
			$fullpath = $cachepath.$cacheFile;
			echo $fullpath;
			if(is_file($fullpath)){
				unlink($fullpath);
			}
		}
	}
}
?>