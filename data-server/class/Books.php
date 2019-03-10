<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/2/25
 * FileExplain:DB-书籍
 * 书籍表：0表示normal 1表示forbidden
 * 简繁：0表示简体 1表示繁体
 */

header("Content-Type:text/html;charset=UTF-8");
require 'DB.php';

class Books
{
	private $forbidden_j = 'book_fb_j';
	private $forbidden_f = 'book_fb_f';
	private $normal_j = 'book_normal_j';
	private $normal_f = 'book_normal_f';
	private $fieldarr = array();
	private $fieldarr_forbidden = '';
	/*字段注释
	 *bookID
	 *bookname
	 *autothor
	 *sex       ——频道
	 *category
	 *tag
	 *state     ——状态
	 *intro     ——简介
	 *creattime——入库时间
	 *  */

	private static $_instance = null;
	private $db;

	//单例模式，
	//虽然php单例模式一般并没有什么卵用(每个页面被解释执行后资源被回收)，
	//但是在此项目逻辑层单个逻辑会多次调用此类，所以在这里还是有用的，
	//因为在处理书籍的时候会同时处理forbidden与normal
	private function __construct()
	{
		$this->db = new DB;
		$temparr = array();
		$temparr = 'bookId,bookname,autothor,sex,category,category,cateId,tag,state,intro,creattime';
		$temparr_f = 'bookId,autothor,sex,category,category,cateId,tag,state,intro,creattime';
		$this->fieldarr[0] = $temparr;
		$this->fieldarr[1] = $temparr_f;
		$temparr = null;
	}

	private function _clone()
	{
	}//...

	public static function getInstance()
	{
		if (!self::$_instance instanceof self) {
			self::$_instance = new self;
		}
		return self::$_instance;
	}

	private function select($sql)
	{
//		echo 'Books-select-sql:' . $sql . '<br>';
		//接收查询结果的数组
		$resultarr = array();
		$i = 0;
		$result = mysql_query($sql);
		while ($row = mysql_fetch_assoc($result)) {
			foreach ($row as $k => $v) {
				$resultarr[$i][$k] = $v;
			}
			$i++;
		}
		return $resultarr;
	}

	private function selectCount($sql)
	{
//		echo 'Books-selectCount-sql:'.$sql.'<br>';
		//接收查询结果的数组
		$result = mysql_query($sql);
		if ($row = mysql_fetch_assoc($result)) {
			return $row['COUNT(*)'];
		}
		return 0;
	}


	//查询所有:
	public function selectForAll($isfb = 0, $jof = 0, $start, $end)
	{
		$table = $this->getTable($isfb, $jof);
		$sql = $this->getsql($table, 0, $this->fieldarr[$isfb], 'creattime', 1, $start, $end,'all');
		return $this->select($sql);

	}

	//根据分类查询
	public function  selectForCategory($isfb = 0, $jof = 0, $cateId, $sex, $start, $end)
	{
		$table = $this->getTable($isfb, $jof);
		$where = array();
		$where['category'] = $cateId;
		$where_sex = '';
		if($sex!=='all') {
			if ($sex == 0) {
				$where_sex = "男";
			} else if ($sex == 1) {
				$where_sex = "女";
			}
			$where['sex'] = $where_sex;
		}
		$sql = $this->getsql($table, $where, $this->fieldarr[$isfb], 'creattime', 1, $start, $end, $sex);
		return $this->select($sql);
	}

	//根据标签查询
	public function  selectForTags($isfb = 0, $jof = 0, $tagid, $start, $end)
	{

		$table = $this->getTable($isfb, $jof);
		$where = $this->db->check_input($tagid);
		$sql = "SELECT {$this->fieldarr[$isfb]} FROM {$table} WHERE tag LIKE '%{$where}%' ORDER BY 'createtime' DESC LIMIT {$start},{$end}";
		return $this->select($sql);
	}

	//根据用户query查询,查询forbidden时将query转码，并且不模糊查询
	public function selectForQuery($isfb = 0, $jof = 0, $query, $start, $end)
	{
		$table = $this->getTable($isfb, $jof);
		$where = $this->db->check_input($query);
		if(!is_numeric($where)){
			$where = substr($where, 1, -1);
		}
		if ($jof == 1) {
//			$where = urlencode($where);
			$sql = "SELECT {$this->fieldarr[$isfb]} FROM {$table} WHERE bookname LIKE '%{$where}%' ORDER BY 'creattime' DESC LIMIT {$start},{$end};";
		} else {
			$sql = "SELECT {$this->fieldarr[$isfb]} FROM {$table} WHERE bookname LIKE '%{$where}%' ORDER BY 'creattime' DESC LIMIT {$start},{$end};";
		}
		return $this->select($sql);
	}

	//根据ID查询单本
	public function selectForId($isfb, $jof, $id, $start, $end)
	{
		$table = $this->getTable($isfb, $jof);
		$where = array();
		$where['bookId'] = $id;
		$sql = $this->getsql($table, $where, $this->fieldarr[$isfb], 'creattime', 1, $start, $end,'all');
		return $this->select($sql);
	}

	//转换查询条件,$table:表名,$condition:where条件数组,$field:查询列数组,$orderby:排序条件,$desc：是否降序
	private function getsql($table, $condition = array(), $field = array(), $orderby, $desc, $start, $end, $sex)
	{
		$where = '';
		$fieldstr = '';
		//判断$condition是否为空，生成wehere条件语句
		if (!empty($condition)) {
			foreach ($condition as $k => $v) {
				$where .= $k . '=' . $this->db->check_input($v) . ' AND ';
			}
			$where = ' WHERE ' . substr(rtrim($where), 0, -3);
		}
		//判断$field是否为空，生成查询列,
		if (!empty($field)) {
			$fieldstr = $field;
		} else {
			$fieldstr = ' * ';
		}
		$sql = "SELECT {$fieldstr} FROM {$table}{$where}";
		//排序条件
		if (!empty($orderby)) {
			$sql = $sql . ' ORDER BY ' . $orderby;
		}
		if (!empty($desc)) {
			$sql = $sql . ' DESC';
		}
		return $sql . " LIMIT {$start},{$end};";
	}

	//查询所有书数量
	public function selectCountForAll($isfb, $jof)
	{
		$table = $this->getTable($isfb, $jof);
		$sql = "SELECT COUNT(*) FROM {$table};";
		return $this->selectCount($sql);
	}

	//根据分类查询数量
	public function selectCountForCategory($isfb, $jof, $category, $sex)
	{
		$table = $this->getTable($isfb, $jof);
		$where = $this->db->check_input($category);
		$where_sex = '';
		if ($sex == 0) {
			$where_sex = "AND sex='男'";
		} else if ($sex == 1) {
			$where_sex = "AND sex='女'";
		}
		$sql = "SELECT COUNT(*) FROM {$table} WHERE category = {$where}{$where_sex};";
		return $this->selectCount($sql);
	}

	//根据Tag查询数量
	public function selectCountForTag($isfb, $jof, $tag)
	{
		$table = $this->getTable($isfb, $jof);
		$where = $this->db->check_input($tag);
		$sql = "SELECT COUNT(*) FROM {$table} WHERE tag LIKE '%{$where}%';";
		return $this->selectCount($sql);
	}

	//根据query查询数量,查询forbidden时将query转码，并且不模糊查询
	public function selectCountForQuery($isfb, $jof, $query)
	{
		$query = urldecode($query);
		$table = $this->getTable($isfb, $jof);
		$where = $this->db->check_input($query);
		if(!is_numeric($where)){
			$where = substr($where, 1, -1);
		}
		if ($jof == 0) {

			$sql = "SELECT COUNT(*) FROM {$table} WHERE bookname LIKE '%{$where}%';";
		} else {
			$sql = "SELECT COUNT(*) FROM {$table} WHERE bookname LIKE '%{$where}%';";
		}
		return $this->selectCount($sql);
	}

	//获取表名
	private function getTable($isfb, $jof)
	{
		if ($isfb == 0) {
			if ($jof == 0) {
				return $this->normal_j;
			} else {
				return $this->normal_f;
			}
		} else {
			if ($jof == 0) {
				return $this->forbidden_j;
			} else {
				return $this->forbidden_f;
			}
		}
	}
}

?>