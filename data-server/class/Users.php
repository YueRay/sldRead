<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/2/26
 * FileExplain:DB-用户
 */
header("Content-Type:text/html;charset=UTF-8");
require 'DB.php';
class Users {

    private $db;

    function __construct(){
        $this->db = new DB;
    }

    //用户登陆查询
    public function selectForId(){

    }

    //用户注册（需要验证）
    public function createUser(){

    }


}
?>