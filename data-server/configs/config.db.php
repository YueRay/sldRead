<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/2/25
 * FileExplain:后端配置文件
 */
$db_config["hostname"] = "localhost:3306"; //服务器地址
$db_config["username"] = "root"; //数据库用户名
$db_config["password"] = "root"; //数据库密码
$db_config["database"] = "slddatabase"; //数据库名称
$db_config["charset"] = "utf8";//数据库编码
$db_config["pconnect"] = 1;//开启持久连接
$db_config["log"] = 1;//开启日志
$db_config["logfilepath"] = './';//开启日志

$fb_j['tablename'] = 'a';
$fb_f['tablename'] = '';
$normor_j['tablename'] = '';
$normor_f['tablename'] = '';

//书签数量限制
$markcount = '5';

?>