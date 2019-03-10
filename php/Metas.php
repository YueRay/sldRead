<?php
/**
 * Created by PhpStorm.
 * User: Mr'Run
 * Date: 2016/3/15
 * FileExplain:
 */

class Metas {
	private $title = '';
	private $keywords = '';
	private $description = '';
	private $jof;
	//构造函数,初始化为默认meta信息
	function Metas($jof){
		if($jof=='0'){
			$this->jof = 'metajt';
			$this->title = '水帘洞小说';
			$this->keywords = '动漫,同人,玄幻';
			$this->description = '同人文学';
		}else if($jof =='1'){
			$this->jof = 'metaft';
			$this->title = '水簾洞小說';
			$this->keywords = '动漫,同人,玄幻';
			$this->description = '同人文学';
		}
	}
	//根据分类获取meta信息
	public function getMeta($category,$type,$jof){
		$metaarr = array();
		if($type == 'id'){
			$bookjson = file_get_contents("http://localhost:80/sldbook/api-server/datainteraction/BooksDI.php?type=id&page=1&query={$category}&jof={$jof}");
			$url = "http://localhost:80/sldbook/api-server/datainteraction/BooksDI.php?type=id&page=1&query={$category}&jof={$jof}";
			$bookinfo = json_decode($bookjson);
			if($bookinfo->normal=='0'){
				$bookname = $this->title;
			}else{
				$bookname = $bookinfo->normal[0]->bookname;
			}
			$metaarr['title']=$bookname;
			$metaarr['keywords'] = $this->keywords;
			$metaarr['description'] = $this->description;
			return $metaarr;
		}

		if($type!='category'){
			$metaarr['title'] = $this->title;
			$metaarr['keywords'] = $this->keywords;
			$metaarr['description'] = $this->description;
			return $metaarr;
		}
		$json_str = file_get_contents('./config-tj/metaseo.txt');
		$meta = json_decode($json_str,true)[$this->jof];
		foreach($meta as $k=>$v){
			if($v['cname']==$category){
				$metaarr['title'] = $v['cname'].'-'.$this->title;
				$metaarr['keywords'] = $v['keywords'];
				$metaarr['description'] = $v['discription'];
				break;
			}
		}
		return $metaarr;
	}
}
//$metas = new Metas('0');
//print_r($metas->getMeta('都市','category',0));
?>