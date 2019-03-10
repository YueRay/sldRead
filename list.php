<?php
include'./php/Metas.php';
$type = $_GET['type'];
$query = $_GET['query'];

$jof = 0;
$meta = new Metas(0);
$metadata = $meta->getMeta($query,$type,0);
?>
<!DOCTYPE html>
<html lang="zh-Hans">
<!--<html lang="zh-Hant">-->
	<head>
    <meta charset="utf-8"/>

    <title><?php echo $metadata['title']; ?></title>
    <!--<title>都市-水簾洞小說</title>-->
    <!--title根据页面适配内容 水帘洞-XX小说 tag页面直接显示水帘洞小说，逻辑用PHP写，关键词和描述也一样。只有分类需要改，标签和搜索结果都不用改。封面页改成书名，禁书不改。-->
    <meta name="keywords" content="<?php echo $metadata['keywords']; ?>" />
    <!--每个分类有专门的关键词和描述，具体的表见mataseo，已经写成json格式，简体对象"mata",繁体"mataft" 如果不是分类，则使用默认的与首页一样的keyword-->
    <meta name="description" content="<?php echo $metadata['description']; ?>"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no"/>
    <!-- Le styles -->
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap.min.css"/>
    <link rel="stylesheet" type="text/css" href="bootstrap/css/bootstrap-responsive.min.css"/>
    <link rel="stylesheet" type="text/css" href="css/style.css"/>
		<link rel="icon" href="./favicon.ico" type="image/x-icon"/>
  	<link rel="shortcut icon" href="./favicon.ico" type="image/x-icon"/>
    <!--[if lte IE 8 ]>
    	<html class="lte_ie8">
      <link rel="stylesheet" type="text/css" href="css/ie8.css"/>
    <![endif]-->
  </head>

  <body>
	<!--页面加载层，数据加载时显示-->
    <div id="loading" style="display: block">
      <div class="spinner">
        <div class="rect1"></div>
        <div class="rect2"></div>
        <div class="rect3"></div>
        <div class="rect4"></div>
        <div class="rect5"></div>
      </div>
      <i></i>
      <p class="typing">加载中,&nbsp;&nbsp;&nbsp;请稍候……</p>
    </div><!--loadingEND-->
    <!--导航开始-->
    <div class="navbar navbar-fixed-top" id="nav">
    <!--导航区域，一般情况下只有简繁转换和搜索动态获取，然而info信息之中，如果是男频，需要在导航之中加入class="navbar-boy",即，完成状态为class="navbar navbar-fixed-top navbar-boy",女频需要加入class="navbar-girl"，和男生类似-->
      <div class="navbar-inner">
        <div class="container">
          <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
            <span class="icon-bar">
            </span>
          </button>
          <a class="brand" href="index_j.html">
          </a>
          <a class="hidden-desktop sitename" href="index_j.html">
            水帘洞小说
            <!--水簾洞小說-->
          </a>
          <div class="nav-collapse collapse">
            <ul class="nav">
              <li>
                <a class="visible-desktop" href="index_j.html" title="www.sldbook.com">
                  首页
                  <!--首頁-->
                </a>
              </li>
              <li>
                <a onclick="tolist('category',encodeURI('都市'),1,'all')" href="javascript:void(0)">
                  <i class="cateicon ds-small hidden-desktop">
                  </i>
                  都市
                </a>
              </li>
              <li>
                <a onclick="tolist('category',encodeURI('武侠'),1,'all')" href="javascript:void(0)">
                  <i class="cateicon wx-small hidden-desktop">
                  </i>
                  武侠
                  <!--武俠-->
                </a>
              </li>
              <li>
                <a onclick="tolist('category',encodeURI('奇幻'),1,'all')" href="javascript:void(0)">
                  <i class="cateicon qh-small hidden-desktop">
                  </i>
                  奇幻
                </a>
              </li>
              <li>
                <a onclick="tolist('category',encodeURI('校园'),1,'all')" href="javascript:void(0)">
                  <i class="cateicon xy-small hidden-desktop">
                  </i>
                  校园
                  <!--校園-->
                </a>
              </li>
              <li class="dropdown visible-desktop">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  更多
                  <b class="caret">
                  </b>
                </a>
                <ul class="dropdown-menu">
                  <li>
                    <a onclick="tolist('category',encodeURI('古代言情'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon gy-small">
                      </i>
                      古言
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('仙侠'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon xx-small">
                      </i>
                      仙侠
                      <!--仙俠-->
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('耽美'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon dm-small">
                      </i>
                      耽美
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('同人'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon tr-small">
                      </i>
                      同人
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('穿越'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon cy-small">
                      </i>
                      穿越
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('历史'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon ls-small">
                      </i>
                      历史
                      <!--歷史-->
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('总裁'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon zc-small">
                      </i>
                      总裁
                      <!--總裁-->
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('科幻'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon kh-small">
                      </i>
                      科幻
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('游戏'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon yx-small">
                      </i>
                      游戏
                      <!--遊戲-->
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('修真'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon xz-small">
                      </i>
                      修真
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('异能'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon yn-small">
                      </i>
                      异能
                      <!--異能-->
                    </a>
                  </li>
                  <li>
                    <a onclick="tolist('category',encodeURI('经典'),1,'all')" href="javascript:void(0)">
                      <i class="cateicon jd-small">
                      </i>
                      经典
                      <!--經典-->
                    </a>
                  </li>
                </ul>
              </li>
              <li>
                <form class="navbar-form form-search" id="search" onkeydown="if(event.keyCode==13)return false">
                  <i style="cursor: pointer" class="icon-search" onclick="searchs()">
                  </i>
                  <!--搜索按钮，繁体替换placeholder="請使用繁體搜索"-->
                  <input class="span2 input-medium search-query" id="query" type="search" placeholder="请用简体搜索">
                  <!--<input class="span2 input-medium search-query" type="search" placeholder="请用繁體搜索">-->
                </form>
              </li>
            </ul>
            <!--简繁切换按钮，繁体内繁&nbsp;/&nbsp;<span style="color:#777;">简</span>'简体替换按钮内容<span style="color:#777;">繁</span>&nbsp;/&nbsp;简'-->
            <button class="pull-right btn btn-inverse" onclick="tofanti()" id="jf">
              <span style="color:#777;">
                繁
              </span>
              &nbsp;/&nbsp;简
            </button>
            <!--<button class="pull-right btn btn-inverse" id="jf">
              繁&nbsp;/&nbsp;<span style="color:#777;">简</span>
            </button>-->
            <!--登录按钮 本期隐藏-->
            <button class="btn btn-inverse btn-login" style="display:none;">
              登录
            </button>
            <button class="btn btn-inverse btn-login" id="history" style="display:none;">
              书签
            </button>
          </div>
          <!--/.nav-collapse -->
        </div>
      </div>
    </div>
    <!--导航结束-->
    <!--导航下方展示区域-->
    <!--404错误层-->
    <div class="container" id="error404">
    	<div class="pic-error404">
        <a class="btn" href="javascript:history.go(-1)">返回上页</a>
        <a class="btn btn-info" href="index.php">回到首页</a>
      </div>
    </div>
    
    <div class="container clearfix main" id="main">
    	<div class="row-fluid" role="main">
      	<!--构建左侧列表项目分类/标签/搜索结果-->
        <div class="span8">
        <!--面包屑导航提示层 在list层中固定展示，根据不同的业务显示不一样的id-->
          <div id="list" style="display: block">
            <!--无搜索结果的提示。默认隐藏.当搜索返回结果为空时，显示这个层，并隐藏hint和cardlist层，另，如果分类和标签没有结果就直接返回404页面-->
            <div class="alert" id="noresult" style="display:none;">
                呀，找不到搜索结果。建议您：
                <ul>
                  <li>检查输入的关键词是否有误，宁可少字，不要错字</li>
                  <li>注意简繁体，搜索词必须要跟网站的简繁版本对应</li>
                  <li>其他的书也很好看哦！</li>
                </ul>
                <a class="btn btn-info" href="list.php?type=all&query=all&sex=all#1">全部书籍</a>
            </div>
            <!--<div class="alert" id="noresult">
                ( ⊙ o ⊙ )！找不到搜索內容，建議您：
                <ul>
                  <li>檢查輸入的關鍵字是否有誤，寧可少字，莫要錯字</li>
                  <li>注意簡繁體，輸入的簡繁請和網站版本對應。技術力量有限轉碼很困難呀</li>
                  <li>要是真的找不到，其他的書也不錯呀~~</li>
                </ul>
                <a class="btn btn-info" href="list.php?cid=all&sex=all#cate">全部書籍</a>
            </div>-->
            <div class="alert-error hint" id="hint" style="display: none">
              <p>
			  <!--书库不用换/页面是分类显示“分类”，标签，搜索相同/ -->
                书库<!--書庫-->&nbsp;&nbsp;/&nbsp;&nbsp;
                <span id="hint-search">
                  搜索&nbsp;&nbsp;/&nbsp;&nbsp;对应的搜索词
                </span>
                <span id="hint-cate" >
                  分类<!--分類-->&nbsp;&nbsp;/&nbsp;&nbsp;
                  校园<!--对应的分类，注意简繁体-->
                </span>
                <span id="hint-tag">
                  标签<!--標籤-->&nbsp;&nbsp;/&nbsp;&nbsp;
                  <i class="tag301 jimg" title="tag" ></i>
                  <!--对应的标签，注意简繁体对应"jimg"和"fimg"-->
                </span>
              </p>
            </div>
            <div id="cardlist" style="display: none">
              <!--list开始-->
              <!--例子 请注意，以下带有注释的部分是一个例子，开发完成后请将例子删除
              单本书信息卡 id：list-00 第一本书的卡片，需要JS修改class的名称与书籍的分类和性别对应例如都市就改成class=“bkcard boy01”-->
              <!--例子完--> 
              <!--NO.1 START-->
              <div class="bkcard" id="list-00">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-00">
                </span>
                <div class="detail">
                  <h1 id="list-sm-00">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-00">
                      </span>
                      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                      <span id="list-zz-00">
                      </span>
                  </p>
                  <p class="dsc" id="list-jj-00">
                  </p>
                  <hr>
                  <div id="list-tag-00">
                  </div>
                </div>
              </div>
              <!--NO.1 END-->
              <!--NO.2 START-->
              <div class="bkcard" id="list-01">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-01">
                </span>
                <div class="detail">
                  <h1 id="list-sm-01">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-01">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-01">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-01">
                  </p>
                  <hr>
                  <div id="list-tag-01">
                  </div>
                </div>
              </div>
              <!--NO.2 END-->
              <!--NO.3 START-->
              <div class="bkcard" id="list-02">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-02">
                </span>
                <div class="detail">
                  <h1 id="list-sm-02">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-02">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-02">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-02">
                  </p>
                  <hr>
                  <div id="list-tag-02">
                  </div>
                </div>
              </div>
              <!--NO.3 END-->
              <!--NO.4 START-->
              <div class="bkcard" id="list-03">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-03">
                </span>
                <div class="detail">
                  <h1 id="list-sm-03">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-03">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-03">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-03">
                  </p>
                  <hr>
                  <div id="list-tag-03">
                  </div>
                </div>
              </div>
              <!--NO.4 END-->
              <!--NO.5 START-->
              <div class="bkcard" id="list-04">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-04">
                </span>
                <div class="detail">
                  <h1 id="list-sm-04">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-04">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-04">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-04">
                  </p>
                  <hr>
                  <div id="list-tag-04">
                  </div>
                </div>
              </div>
              <!--NO.5 END-->
              <!--NO.6 START-->
              <div class="bkcard" id="list-05">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-05">
                </span>
                <div class="detail">
                  <h1 id="list-sm-05">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-05">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-05">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-05">
                  </p>
                  <hr>
                  <div id="list-tag-05">
                  </div>
                </div>
              </div>
              <!--NO.6 END-->
              <!--NO.7 START-->
              <div class="bkcard" id="list-06">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-06">
                </span>
                <div class="detail">
                  <h1 id="list-sm-06">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-06">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-06">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-06">
                  </p>
                  <hr>
                  <div id="list-tag-06">
                  </div>
                </div>
              </div>
              <!--NO.7 END-->
              <!--NO.8 START-->
              <div class="bkcard" id="list-07">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-07">
                </span>
                <div class="detail">
                  <h1 id="list-sm-07">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-07">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-07">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-07">
                  </p>
                  <hr>
                  <div id="list-tag-07">
                  </div>
                </div>
              </div>
              <!--NO.8 END-->
              <!--NO.9 START-->
              <div class="bkcard" id="list-08">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-08">
                </span>
                <div class="detail">
                  <h1 id="list-sm-08">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-08">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-08">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-08">
                  </p>
                  <hr>
                  <div id="list-tag-08">
                  </div>
                </div>
              </div>
              <!--NO.9 END-->
              <!--NO.10 START-->
              <div class="bkcard" id="list-09">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-09">
                </span>
                <div class="detail">
                  <h1 id="list-sm-09">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-09">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-09">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-09">
                  </p>
                  <hr>
                  <div id="list-tag-09">
                  </div>
                </div>
              </div>
              <!--NO.10 END-->
              <!--NO.11 START-->
              <div class="bkcard" id="list-10">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-10">
                </span>
                <div class="detail">
                  <h1 id="list-sm-10">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-10">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-10">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-10">
                  </p>
                  <hr>
                  <div id="list-tag-10">
                  </div>
                </div>
              </div>
              <!--NO.11 END-->
              <!--NO.12 START-->
              <div class="bkcard" id="list-11">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-11">
                </span>
                <div class="detail">
                  <h1 id="list-sm-11">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-11">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-11">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-11">
                  </p>
                  <hr>
                  <div id="list-tag-11">
                  </div>
                </div>
              </div>
              <!--NO.12 END-->
              <!--NO.13 START-->
              <div class="bkcard" id="list-12">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-12">
                </span>
                <div class="detail">
                  <h1 id="list-sm-12">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-12">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-12">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-12">
                  </p>
                  <hr>
                  <div id="list-tag-12">
                  </div>
                </div>
              </div>
              <!--NO.13 END-->
              <!--NO.14 START-->
              <div class="bkcard" id="list-13">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-13">
                </span>
                <div class="detail">
                  <h1 id="list-sm-13">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-13">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-13">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-13">
                  </p>
                  <hr>
                  <div id="list-tag-13">
                  </div>
                </div>
              </div>
              <!--NO.14 END-->
              <!--NO.15 START-->
              <div class="bkcard" id="list-14">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-14">
                </span>
                <div class="detail">
                  <h1 id="list-sm-14">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-14">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-14">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-14">
                  </p>
                  <hr>
                  <div id="list-tag-14">
                  </div>
                </div>
              </div>
              <!--NO.15 END-->
              <!--NO.16 START-->
              <div class="bkcard" id="list-15">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-15">
                </span>
                <div class="detail">
                  <h1 id="list-sm-15">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-15">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-15">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-15">
                  </p>
                  <hr>
                  <div id="list-tag-15">
                  </div>
                </div>
              </div>
              <!--NO.16 END-->
              <!--NO.17 START-->
              <div class="bkcard" id="list-16">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-16">
                </span>
                <div class="detail">
                  <h1 id="list-sm-16">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-16">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-16">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-16">
                  </p>
                  <hr>
                  <div id="list-tag-16">
                  </div>
                </div>
              </div>
              <!--NO.17 END-->
              <!--NO.18 START-->
              <div class="bkcard" id="list-17">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-17">
                </span>
                <div class="detail">
                  <h1 id="list-sm-17">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-17">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-17">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-17">
                  </p>
                  <hr>
                  <div id="list-tag-17">
                  </div>
                </div>
              </div>
              <!--NO.18 END-->
              <!--NO.19 START-->
              <div class="bkcard" id="list-18">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-18">
                </span>
                <div class="detail">
                  <h1 id="list-sm-18">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-18">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-18">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-18">
                  </p>
                  <hr>
                  <div id="list-tag-18">
                  </div>
                </div>
              </div>
              <!--NO.19 END-->
              <!--NO.20 START-->
              <div class="bkcard" id="list-19">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-19">
                </span>
                <div class="detail">
                  <h1 id="list-sm-19">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-19">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-19">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-19">
                  </p>
                  <hr>
                  <div id="list-tag-19">
                  </div>
                </div>
              </div>
              <!--NO.20 END-->
              <!--NO.21 START-->
              <div class="bkcard" id="list-20">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-20">
                </span>
                <div class="detail">
                  <h1 id="list-sm-20">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-20">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-20">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-20">
                  </p>
                  <hr>
                  <div id="list-tag-20">
                  </div>
                </div>
              </div>
              <!--NO.21 END-->
              <!--NO.22 START-->
              <div class="bkcard" id="list-21">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-21">
                </span>
                <div class="detail">
                  <h1 id="list-sm-21">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-21">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-21">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-21">
                  </p>
                  <hr>
                  <div id="list-tag-21">
                  </div>
                </div>
              </div>
              <!--NO.22 END-->
              <!--NO.23 START-->
              <div class="bkcard" id="list-22">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-22">
                </span>
                <div class="detail">
                  <h1 id="list-sm-22">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-22">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-22">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-22">
                  </p>
                  <hr>
                  <div id="list-tag-22">
                  </div>
                </div>
              </div>
              <!--NO.23 END-->
              <!--NO.24 START-->
              <div class="bkcard" id="list-23">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-23">
                </span>
                <div class="detail">
                  <h1 id="list-sm-23">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-23">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-23">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-23">
                  </p>
                  <hr>
                  <div id="list-tag-23">
                  </div>
                </div>
              </div>
              <!--NO.24 END-->
              <!--NO.25 START-->
              <div class="bkcard" id="list-24">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-24">
                </span>
                <div class="detail">
                  <h1 id="list-sm-24">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-24">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-24">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-24">
                  </p>
                  <hr>
                  <div id="list-tag-24">
                  </div>
                </div>
              </div>
              <!--NO.25 END-->
              <!--NO.26 START-->
              <div class="bkcard" id="list-25">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-25">
                </span>
                <div class="detail">
                  <h1 id="list-sm-25">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-25">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-25">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-25">
                  </p>
                  <hr>
                  <div id="list-tag-25">
                  </div>
                </div>
              </div>
              <!--NO.26 END-->
              <!--NO.27 START-->
              <div class="bkcard" id="list-26">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-26">
                </span>
                <div class="detail">
                  <h1 id="list-sm-26">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-26">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-26">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-26">
                  </p>
                  <hr>
                  <div id="list-tag-26">
                  </div>
                </div>
              </div>
              <!--NO.27 END-->
              <!--NO.28 START-->
              <div class="bkcard" id="list-27">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-27">
                </span>
                <div class="detail">
                  <h1 id="list-sm-27">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-27">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-27">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-27">
                  </p>
                  <hr>
                  <div id="list-tag-27">
                  </div>
                </div>
              </div>
              <!--NO.28 END-->
              <!--NO.29 START-->
              <div class="bkcard" id="list-28">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-28">
                </span>
                <div class="detail">
                  <h1 id="list-sm-28">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-28">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-28">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-28">
                  </p>
                  <hr>
                  <div id="list-tag-28">
                  </div>
                </div>
              </div>
              <!--NO.29 END-->
              <!--NO.30 START-->
              <div class="bkcard" id="list-29">
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="list-wj-29">
                </span>
                <div class="detail">
                  <h1 id="list-sm-29">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="list-fl-29">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="list-zz-29">
                    </span>
                  </p>
                  <p class="dsc" id="list-jj-29">
                  </p>
                  <hr>
                  <div id="list-tag-29">
                  </div>
                </div>
              </div>
              <!--NO.30 END-->          
              <!--翻页-->
              <!--翻页整体逻辑跟之前一样，把点相关的逻辑以及始终显示第一页的逻辑去掉就行
              总项目数量大于30，则显示翻页模块
              第一页时，列表的第一项向前翻页按钮添加class="disabled"，
              同理最后一页时最后一页向后翻页按钮添加class="disabled"
              不能使用的按钮就将a标签替换成span标签
              当前页添加class="active"-->
              <div class="pagination pagination-centered" id="list-pages" style="display:block">
                <ul>
                	<!--向前翻页按钮，可用时把class删掉，标签换成a标签添加向前翻页的锚定链接就行-->
                  <li class="disabled" id="last"><a href="javascript:last()">&laquo;</a></li>
                  <!--第一页是当前页，所以有active的类，如果翻页把这个类删掉，把class="active"放到下一页-->
                  <li class="active" id="one"><a onclick="" href="javascript:void(0)">1</a></li>
                  <li id="two"><a href="javascript:void(0)">2</a></li>
                  <li id="three"><a href="javascript:void(0)" >3</a></li>
                  <li id="four"><a href="javascript:void(0)" >4</a></li>
                  <li id="five"><a href="javascript:void(0)" >5</a></li>
                  <!--向后翻页按钮，不可用时格式和向前翻页按钮当前的状态一样-->
                  <li id="next"><a href="#" >&raquo;</a></li>
                </ul>
              </div>
             </div><!--listEND-->
            <!--info START-->
            <div id="info" style="display: none">
              <div class="bkcard" id="infocard">
                <!--书籍信息卡，与list中一致。-->
                <span class="cardbgp">
                </span>
                <span class="bkstatus" id="infocard-wj">
                </span>
                <div class="detail">
                  <h1 id="infocard-sm">
                    水帘洞小说
                    <!--水簾洞小說-->
                  </h1>
                  <p class="bkmata">
                    分类
                    <!--分類-->
                    &nbsp;&nbsp;
                    <span id="infocard-fl">
                    </span>
                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;作者&nbsp;&nbsp;
                    <span id="infocard-zz">
                    </span>
                  </p>
                  <p class="dsc" id="infocard-jj">
                  </p>
                  <hr>
                  <div id="infocard-tag">
                  </div>
                </div>
              </div>
              <!--infocard END-->
              <!--阅读历史，本期不显示，下一期在进入页面时做判断，如果用户对应书籍ID有阅读历史则显示该层，如果没有则依然不显示-->
              <div class="widget" id="info-bookmark" style="display:none;">
                <div class="sidecontent">
                  <h2>
                    阅读历史
                  </h2>
                  <p>上次读到：<span id="info-bkmark-cname"><a href="#">书签所在章节名这个写得长一点儿可以测试</a></span></p>
                  <span class="pull-right" id="info-bkmark-time">2010-10-10</span><br>
                  <button class="btn pull-right">继续阅读<!--繼續閱讀--></button>
                  <button class="btn pull-right">读下一章<!--讀下一章--></button>
                  <!--如果书签已经是最后一章，则在读下一章的class上加入一个"disabled的类"下面是一个例子-->
                  <!--<button class="btn pull-right disabled">读下一章<button>-->
                </div>
              </div>
              <div class="widget" id="info-download">
                <div class="sidecontent">
                  <h2>
                    下载地址
                    <!--下載地址-->
                  </h2>
                  <div>
                    <!--生成下載地址的位置，下方的图片SRC为google的二维码生成器，将chl参数改成下载链接即可。-->
                    <div class="span4 visible-desktop" id="downloadqr">
					  <div><p> </p> <p> </p></div> 
                      <img id="downloadimgs" style="width:150px;height:150px" src="img/urladdress.png" alt="下载地址">
                      <div style="height: 10px;"><p> </p> <p> </p></div>              <!--<h5>掃碼下載全文</h5>-->
                    </div>
                    <ul  class="span8">
					<!--下载地址禁止爬去：所有搜索引擎-->
                      <li><a id="down1" href="#">下载地址1</a></li>
                      <li><a id="down2" href="#">下载地址2</a></li>
                    </ul>
					
                  </div>
                </div>
              </div>
              <div class="widget" id="info-chapter">
                <div class="sidecontent">
                  <h2>
                    在线阅读
                    <!--在線閱讀-->
                  </h2>
                  <!--章节列表-->
                  <div id="chapterlist">
                    <ul id="seclist">
                      <!--按照顺序写入章节即可。默认写了打开新窗口，需要控制窗口宽度小于767px时在当前窗口打开-->
<!--                      <li class="span4">-->
<!--                        <a href="#" target="_blank">章节名1</a>-->
<!--                      </li>-->
<!--                      <li class="span4">-->
<!--                        <a href="#" target="_blank">章节名2</a>-->
<!--                      </li>-->
<!--                      <li class="span4">-->
<!--                        <a href="#" target="_blank">章节名3</a>-->
<!--                      </li>-->
                    </ul>
                  </div>
                </div>
              </div>      
            </div><!--info END-->        
          </div>
        </div><!--span8END-->
        <!--侧边栏-->
        <div class="span4" style="float:right; display: none" id="righttj">
        	<!--标签云开始-->
        	<div class="widget" ID="tagcloud">
          	<div class="sidecontent">
              <h2>
              	标签云
                <!--標籤云-->
              </h2>
              <div class="tag-cloud" id="tagtj">
              <!--简体标签两个类，jimg和tag+id，以下为一个例子-->
                <a class="tag301 jimg" title="tag" href="tag.php?id=301"></a>
                <!--<a class="tag301 fimg" title="tag" href="tag.php?id=301"></a>-->
                <a class="moretag" title="tag" href="#moretag">...</a>
              </div>
            </div>
          </div><!--#tagcloud END-->
          <!--火爆推荐开始-->
          <div class="widget" ID="hbtj">
          	<div class="sidecontent">
              <h2>
              	火爆推荐
                <!--火爆推薦-->
              </h2>
              <ul>
                <li id="hbtj00">
                  <a href="#">書名</a>
                </li>
                <li id="hbtj01"></li>
                <li id="hbtj02"></li>
                <li id="hbtj03"></li>
                <li id="hbtj04"></li>
                <li id="hbtj05"></li>
                <li id="hbtj06"></li>
                <li id="hbtj07"></li>
                <li id="hbtj08"></li>
                <li id="hbtj09"></li>
              </ul>
            </div>
          </div><!--#hbtjEND-->
          <!--总推荐榜开始-->
          <div class="widget" ID="ztjb">
          	<div class="sidecontent">
              <h2>
              	总推荐榜
                <!--總推薦榜-->
              </h2>
              <ul>
                <li id="ztjb00"></li>
                <li id="ztjb01"></li>
                <li id="ztjb02"></li>
                <li id="ztjb03"></li>
                <li id="ztjb04"></li>
                <li id="ztjb05"></li>
                <li id="ztjb06"></li>
                <li id="ztjb07"></li>
                <li id="ztjb08"></li>
                <li id="ztjb09"></li>
              </ul>
             </div>
          </div><!--#ztjbEND-->
      	</div><!--span4 END-->
      </div><!--fluid end-->
    </div><!--页面内容完 #mainEND-->
    <!--footer start-->
    <div id="footer-nav" style="display:none;">
    	<div class="container">
      	<div class="row-fluid">
        	<div class="span6">
          	<div class="widget">
            	<div class="sidecontent boy">
              	<h2>男生</h2>
                <div class="cate-cloud">
					<a onclick="tolist('category',encodeURI('都市'),1,0)" href="javascript:void(0)">都市</a>
					<a onclick="tolist('category',encodeURI('武侠'),1,0)" href="javascript:void(0)">武侠</a>
					<a onclick="tolist('category',encodeURI('奇幻'),1,0)" href="javascript:void(0)">奇幻</a>
					<a onclick="tolist('category',encodeURI('仙侠'),1,0)" href="javascript:void(0)">仙侠</a>
					<a onclick="tolist('category',encodeURI('修真'),1,0)" href="javascript:void(0)">修真</a>
					<a onclick="tolist('category',encodeURI('异能'),1,0)" href="javascript:void(0)">异能</a>
					<a onclick="tolist('category',encodeURI('科幻'),1,0)" href="javascript:void(0)">科幻</a>
					<a onclick="tolist('category',encodeURI('历史'),1,0)" href="javascript:void(0)">历史</a>
					<a onclick="tolist('category',encodeURI('穿越'),1,0)" href="javascript:void(0)">穿越</a>
					<a onclick="tolist('category',encodeURI('同人'),1,0)" href="javascript:void(0)">同人</a>
					<a onclick="tolist('category',encodeURI('游戏'),1,0)" href="javascript:void(0)">游戏</a>
					<a onclick="tolist('category',encodeURI('校园'),1,0)" href="javascript:void(0)">校园</a>
					<a onclick="tolist('category',encodeURI('经典'),1,0)" href="javascript:void(0)">经典</a>
                	<!--<a href="list.php?cid=01&sex=boy#cate">都市</a>
                  <a href="list.php?cid=02&sex=boy#cate">武俠</a>
                  <a href="list.php?cid=03&sex=boy#cate">奇幻</a>
                  <a href="list.php?cid=04&sex=boy#cate">仙俠</a>
                  <a href="list.php?cid=05&sex=boy#cate">修真</a>
                  <a href="list.php?cid=07&sex=boy#cate">異能</a>
                  <a href="list.php?cid=08&sex=boy#cate">科幻</a>
                  <a href="list.php?cid=09&sex=boy#cate">歷史</a>
                  <a href="list.php?cid=11&sex=boy#cate">穿越</a>
                  <a href="list.php?cid=12&sex=boy#cate">同人</a>
                  <a href="list.php?cid=13&sex=boy#cate">遊戲</a>
                  <a href="list.php?cid=14&sex=boy#cate">校園</a>
                  <a href="list.php?cid=15&sex=boy#cate">經典</a>-->					
                </div>
              </div>
            </div>
          </div>
          <div class="span6">
          	<div class="widget">
            	<div class="sidecontent girl">
              	<h2>女生</h2>
                <div class="cate-cloud">
					<a onclick="tolist('category',encodeURI('都市'),1,1)" href="javascript:void(0)">都市</a>
					<a onclick="tolist('category',encodeURI('武侠'),1,1)" href="javascript:void(0)">武侠</a>
					<a onclick="tolist('category',encodeURI('奇幻'),1,1)" href="javascript:void(0)">奇幻</a>
					<a onclick="tolist('category',encodeURI('仙侠'),1,1)" href="javascript:void(0)">仙侠</a>
					<a onclick="tolist('category',encodeURI('耽美'),1,1)" href="javascript:void(0)">耽美</a>
					<a onclick="tolist('category',encodeURI('异能'),1,1)" href="javascript:void(0)">异能</a>
					<a onclick="tolist('category',encodeURI('科幻'),1,1)" href="javascript:void(0)">科幻</a>
					<a onclick="tolist('category',encodeURI('总裁'),1,1)" href="javascript:void(0)">总裁</a>
					<a onclick="tolist('category',encodeURI('穿越'),1,1)" href="javascript:void(0)">穿越</a>
					<a onclick="tolist('category',encodeURI('同人'),1,1)" href="javascript:void(0)">同人</a>
					<a onclick="tolist('category',encodeURI('游戏'),1,1)" href="javascript:void(0)">游戏</a>
					<a onclick="tolist('category',encodeURI('校园'),1,1)" href="javascript:void(0)">校园</a>
					<a onclick="tolist('category',encodeURI('古代言情'),1,1)" href="javascript:void(0)">古代言情</a>
                	<!--<a href="list.php?cid=01&sex=boy#cate">都市</a>
                  <a href="list.php?cid=02&sex=boy#cate">武俠</a>
                  <a href="list.php?cid=03&sex=boy#cate">奇幻</a>
                  <a href="list.php?cid=04&sex=boy#cate">仙俠</a>
                  <a href="list.php?cid=06&sex=boy#cate">耽美</a>
                  <a href="list.php?cid=07&sex=boy#cate">異能</a>
                  <a href="list.php?cid=08&sex=boy#cate">科幻</a>
                  <a href="list.php?cid=10&sex=boy#cate">總裁</a>
                  <a href="list.php?cid=11&sex=boy#cate">穿越</a>
                  <a href="list.php?cid=12&sex=boy#cate">同人</a>
                  <a href="list.php?cid=13&sex=boy#cate">遊戲</a>
                  <a href="list.php?cid=14&sex=boy#cate">校園</a>
                  <a href="list.php?cid=16&sex=boy#cate">古代言情</a>-->
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="footer" style="display: none">
    	<div class="container">
      		<p class="copyright">Email: dasheng@sldbook.com</p>
          <p class="copyright">侵权请联系</p>
        	<p class="copyright">Copyright © 2016 水簾洞小說. All Rights Reserved.</p>
        </div>
    </div>
    <p id="back-to-top"><a href="#top"></a></p>
    <!--footerend-->
    <!-- Le javascript  -->
    <!--注意，上线前框架需要切换地址，除了jquery，bootstrap也可以找CDN地址加载-->
		<!--<script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>-->
		<script type="text/javascript" src="js/jquery-1.7.2.min.js"></script>
    <script type="text/javascript" src="bootstrap/js/bootstrap.js"></script>
    <!--返回到顶部的JS 可以和其他JS合并,注意阅读页不需要返回顶部-->
    <script type="text/javascript" src="js/backtotop.js"></script>
	<script type="text/javascript" src="js/functions.js"></script>
	<script type="text/javascript">
		var GET = $.urlGet();
		var type = GET['type'];
		var query = GET['query'];
		var sex = GET['sex'];
		sex = sex.split('#')[0];
		query = decodeURI(query);
		var jf = 0;
		var page = location.hash;
		if(page == null||page == undefined){
			page = '#1';
			location.hash = 1;
		}
		page = page.replace('#','');
		var cookie_jof =  getCookie('jof');
		if(cookie_jof == null||cookie_jof == 'undefind'){
			setCookie('jof',0);
			cookie_jof = 0;
		}
		if(cookie_jof != 0){
			tofanti();
		}
		function tofanti(){
			setCookie('jof',1);
			if(type=='category'){
				switch(query){
					case '武侠':
						query = '武俠';
						break;
					case '异能':
						query = '異能';
						break;
					case '历史':
						query = '歷史';
						break;
					case '游戏':
						query = '遊戲';
						break;
					case '校园':
						query = '校園';
						break;
					case '经典':
						query = '經典';
						break;
					case '总裁':
						query = '總裁';
						break;
					case '仙侠':
						query = '仙俠';
						break;
					default :
						break;
				}
			}
			location.href = 'list_f.php?type='+type+'&query='+query+'&sex='+sex+'#'+page;
		}
	</script>
	<script type="text/javascript" src="js/list.js"></script>
	<script type="text/javascript">

		var funs = new Functions();
		//获取list每本书
		function getDatas(type,query,jof,page,sex){
			showhint(type,query,jof);
			$('#righttj').addClass('span4 hidden-phone');
			var url = "api-server/datainteraction/BooksDI.php?type="+type+"&query="+encodeURI(query)+"&jof="+jof+"&page="+page+"&sex="+sex;
			alert(url);
			funs.gets(url,setData,jof,page);
		}
		//获取info层但本书信息
		function getbookinfo(type,query,jof,page,sex){
			showhint(type,query,jof);
			$('#righttj').addClass('span4');
			var url = "api-server/datainteraction/BooksDI.php?type="+type+"&query="+query+"&jof="+jof+"&page="+page+"&sex="+sex;
			funs.gets(url,setInfo,jof);
		}
		//翻页函数
		function pageing(num){
			loadings();
			location.hash = num;
			getDatas(type,query,jf,num,sex);
		}
		function listshow(type){
			loadings();
			if(type!='id'){
				getDatas(type,query,jf,page,sex);
			}else{
				getbookinfo(type,query,jf,page,sex);
			}
		}
		function readbook(bookid,page,seccount){
			var url_read = "reader.html?seccount="+seccount+"&bookid="+bookid+"#"+page;
			if($(window).width()>767){
				window.open(url_read);
			}else{
				location.href = url_read;
			}
		}

		function tolist(types,querys,pages,sexs){
			location.href = 'list.php?type='+types+'&query='+querys+'&sex='+sexs+'#'+pages;
		}
		listshow(type);
	</script>
	<script type="text/javascript" src="js/Tat.js"></script>
	<script>
		$(document).ready(function () {
			$('#search').keydown(function (event) {
				var curKey = event.which;
				if (curKey == 13) {
					var query = $('#query').val();
					if (query.length == 0) {
						alert("请输入搜索内容");
					} else {
						location.href = 'list.php?type=query&query='+query+'&sex=0#1';
						tolist('query',query,1,'all');
					}
				}
			});
		});
		function searchs(){
			var query = $('#query').val();
			if (query.length == 0) {
				alert("请输入搜索内容");
			} else {
				location.href = 'list.php?type=query&query=' + query + '&sex=0#1';
			}
		}
	</script>
</body></html>