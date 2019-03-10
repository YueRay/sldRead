<?php

/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/2/25
 * Time: 4:52
 * 数据库连接类
 * 数据库配置，连接
 */
header("Content-Type:text/html;charset=UTF-8");

class DB{

    //Db链接资源
    public $conn;

    function __construct(){
        require_once( '../configs/config.db.php');
        $this->connect($db_config["hostname"], $db_config["username"], $db_config["password"], $db_config["database"], $db_config["pconnect"]);
    }

	/*mysql连接函数
	 *  $dbhost:数据库地址,
	 *  $dbuser:用户名,
	 *  $dbpw：密码,
	 *  $dbname：数据库名,
	 *  $pconnect = 0：是否延时连接,
	 *  $charset='utf8'：字符集
	 * */
    private function connect($dbhost, $dbuser, $dbpw, $dbname, $pconnect = 0,$charset='utf8'){
        if($pconnect == 0){
            $this->conn = @mysql_connect($dbhost,$dbuser,$dbpw,true);
            if(!$this->conn){
                $this->halt('connectERROR');
            }
        } else {
            $this->conn = @mysql_pconnect($dbhost,$dbuser,$dbpw);
            if(!$this->conn){
                $this->halt('pconnectERROR');
            }
        }
        if(!@mysql_select_db($dbname,$this->conn)){
            $this->halt('databaseSELETE_ERROR');
        }
        @mysql_query('set names '.$charset);
    }

    //sql防注入转义
    function check_input($value){
		$value = urldecode($value);
        // 去除斜杠
        if (get_magic_quotes_gpc())
        {
            //删除反斜杠
            $value = stripslashes($value);
        }

        // 如果不是数字则加引号
        if (!is_numeric($value)){
			$value = str_replace('"','',$value);
			$value = str_replace('\'','',$value);
			$value = str_replace('%','',$value);
			$value = str_replace('*','',$value);
			$value = str_replace('/','',$value);
			$value = str_replace(';','',$value);
			$value = str_replace(':','',$value);
			$value = "'".$value."'";
        }
        return $value;
    }

    //错误提示
    private function halt($msg='') {
        $msg .= "\r\n".mysql_error();
        die($msg);
    }

}

?>