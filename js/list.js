/**
 * Created by Mr'Run on 2016/3/11.
 */

//get请求的callback
function setData(data,status,jof,page){
    $('#nav').removeClass('navbar-boy');
    $('#nav').removeClass('navbar-gril');
    //如果请求失败
    if(status!='success'){
        $('#error404').show();
        $('#hint').hide();
        return;
    }
    if(jof==0){
        jof='j';
    }else{
        jof='f';
    }
    var datas = funs.bookdata(data,jof);
    var books = datas.normals;
    var fb = datas.forbiddens;
    var count = datas.count;
    if(books.length+fb.length==0){
        showlist('error','list');
    }else {
        showpage(count,page);
        //判断禁书数量
        if (fb.length != 0) {
            var num = showData(fb, 0);
            num = showData(books, num);
        } else {
            num = showData(books, 0, books.length);
        }
        if (num < 29) {
            hindediv(num);
        }else{
            showdiv();
        }
        showlist('success','list');
    }
    function showData(books,numstart){
        for(var i =0;i<books.length;i++){
            var num = funs.add0(numstart);
            //设置每本书的div层的class
            $('#list-'+num).removeClass();
            $('#list-'+num).addClass(books[i].catename);
            //设置完结状态
            books[i].state($('#list-wj-'+num));
            //书名
            $('#list-sm-'+num).html(books[i].bookname);
            //分类
            $('#list-fl-'+num).html(books[i].category);
            //作者
            $('#list-zz-'+num).text(books[i].autothor);
            //简介
            $('#list-jj-'+num).html(books[i].intro);
            //标签
            $('#list-tag-'+num).html(books[i].tags);
            numstart ++;
        }
        return numstart;
    }
    //如果此页不足30本书，隐藏剩余div
    function hindediv(start){
        for(var i = start;i<30;i++){
            var num = funs.add0(i);
            $('#list-'+num).hide();
        }
    }
    function showdiv(){
        for(var i = 0;i<30;i++){
            var num = funs.add0(i);
            $('#list-'+num).show();
        }
    }
}
//get请求时info的callback
function setInfo(data,status,jf){
    var jof;
    //如果请求失败
    if(status != 'success'){
        $('#error404').show();
        $('#hint').hide();
        return;
    }
    if(jf==0){
        jof='j';
    }else{
        jof='f';
    }
    var datas = funs.bookdata(data,jof);
    var book = datas.normals;
    if(book.length == 0){
        book = datas.forbiddens;
    }
    if(book.length == 0){
        showlist('error','info');
        return;
    }else{

        $('#infocard').addClass(book[0].catename);
        book[0].state($('#infocard-wj'));
        $('#infocard-sm').html(book[0].bookname);
        $('#infocard-fl').html(book[0].category);
        $('#infocard-zz').html(book[0].autothor);
        $('#infocard-jj').html(book[0].intro);
        $('#infocard-tag').html(book[0].tags);
        if(book[0].sex=='男'){
            $('#nav').removeClass('navbar-girl');
            $('#nav').addClass('navbar-boy');
        }else{
            $('#nav').addClass('navbar-girl');
            $('#nav').removeClass('navbar-boy');
        }
        //需要修改地址
        var bookname = '';
        if(book[0].booknames=='undefined'){
            bookname = book[0].bookid;
        }else{
            bookname = book[0].booknames;
        }
        var downloadurl = '/sldbook/api-server/datainteraction/DownLoad.php?book='+bookname+'_'+book[0].bookid+'_'+jf;
        var src = 'https://chart.googleapis.com/chart?cht=qr&chs=150x150&choe=UTF-8&chld=L|4&chl=http://192.168.3.10:80'+downloadurl;
        $('#downloadimg').attr('src',src);
        $('#down1').attr('href','http://192.168.3.10:80'+downloadurl);
        $('#down2').attr('href','http://192.168.3.10:80'+downloadurl);
        //加载阅读历史
        infomarks();
        //加载章节列表
        setSec(book[0].secname,book[0].bookid,jf);
        infoSecs();
        infodownload();
        showlist('success','info');
        $('#info').show();
    }
}
//get请求章节列表的callback
function setSec(bookname,bookid,jof){
    var url = "./api-server/datainteraction/BookContent.php?page=1&type=count&bookid="+bookid+"&jof="+jof;
    var li = "<li class='span4'>";
    var liend = "</li>";
    var secs = '';
    $.get(url,function(data,status){
        for(var i =1;i<=data;i++){
            var secnum = "<a onclick='readbook("+bookid+","+i+","+data+")' href='javascript:void(0)'>"+bookname+"_"+i+"</a>";
            secs += li + secnum + liend;
        }
        $('#seclist').html(secs);
    });
}

//加载时隐藏的元素
function loadings(){
    //显示加载中
    $('#loading').show();
    //隐藏右侧推荐
    $('#righttj').hide();
    //隐藏list
    $('#cardlist').hide();
    //隐藏foot
    $('#footer-nav').hide();
    $('#footer').hide();
    //隐藏info层
    $('#info').hide();
    //隐藏空结果提示层
    $('#noresult').hide();
}
//加载完成时显示的元素
function showlist(status,listorinfo){
    $('#loading').hide();
    $('#righttj').show();
    $('#footer-nav').show();
    $('#footer').show();
    if(status=='success'){
        $('#loading').hide();
        if(listorinfo=='list'){
            $('#cardlist').show();
            $('#hint').show();
        }else{
            $('#info').show();
            $('#hint').hide();
        }
    }else{
        $('#cardlist').hide();
        $('#noresult').show();
        $('#hint').hide();
    }

}
//加载hint
function showhint(type,query,jof){
    hintarr = [];
    var tagjof;
    if(type=='all'){
        $('#hint').hide();
    }else if(jof==0){
        hintarr['cate'+jof] = '分类';
        hintarr['query'+jof] = '搜索';
        hintarr['tag'+jof] = '标签';
        tagjof = 'j';
    }else if(jof==1){
        hintarr['cate'+jof] = '分類';
        hintarr['query'+jof] = '搜索';
        hintarr['tag'+jof] = '標籤';
        tagjof = 'f';
    }else{
        $('#hint').hide();
    }
    switch (type){
        case 'category':
            $('#hint-cate').html(hintarr['cate'+jof]+'&nbsp;&nbsp;/&nbsp;&nbsp;'+decodeURI(query));
            $('#hint-cate').show();
            $('#hint-search').hide();
            $('#hint-tag').hide();
            $('#hint').hide();
            break;
        case 'query':
            $('#hint-cate').hide();
            $('#hint-search').html(hintarr['query'+jof]+'&nbsp;&nbsp;/&nbsp;&nbsp;'+decodeURI(query));
            $('#hint-search').show();
            $('#hint-tag').hide();
            $('#hint').hide();
            break;
        case 'tag':
            $('#hint-cate').hide();
            $('#hint-search').hide();
            $('#hint-tag').html(hintarr['tag'+jof]+'&nbsp;&nbsp;/&nbsp;&nbsp;<i class="tag'+query+' '+tagjof+'img" title="tag" ></i>');
            $('#hint-tag').show();
            $('#hint').hide();
            break;
        case 'all':
            $('#hint-cate').html('全部&nbsp;&nbsp;/&nbsp;&nbsp;全部书籍');
            $('#hint-cate').show();
            $('#hint-search').hide();
            $('#hint-tag').hide();
            $('#hint').hide();
        default:
            $('#hint').hide();
            break;
    }

}
//加载翻页
function showpage(bookscount,num){
    if(bookscount<=30){
        $('#list-pages').hide();
        return;
    }
    var last = $('#last');
    var next = $('#next');
    var one = $('#one');
    var two = $('#two');
    var three = $('#three');
    var four = $('#four');
    var five = $('#five');
    var pagearr = [];
    pagearr[0] = one;
    pagearr[1] = two;
    pagearr[2] = three;
    pagearr[3] = four;
    pagearr[4] = five;
    //判断页数是否小于5,如果小于5则隐藏多余的按钮,如果只有一页则隐藏所有翻页按钮
    var pagecount =Math.ceil(bookscount/30);
    if(pagecount<=1){
        $('#list-pages').hide();
        return;
    }else if(pagecount<5){
        for(var i = 0;i<5;i++){
            if(i<pagecount){
                pagearr[i].show();
            }else{
                pagearr[i].hide();
            }
        }
    }else{
        for(var i = 0;i<5;i++){
            pagearr[i].show();
        }
    }
    $('#list-pages').show();
    //当为第一页时
    if(num==1){
        pagearr[0].addClass('active');
        last.addClass('disabled');
        next.removeClass();
        getpagenum(1);
        newlast(0);
        newnext(2);
    }else if(num == pagecount){
        pagearr[4].addClass('active');
        next.addClass('disabled');
        last.removeClass();
        if(pagecount<=5){
            getpagenum(1);
        }else{
            getpagenum(pagecount-4)
        }
        newlast(num-1);
        newnext(0);
    }else if(num == 2){
        last.removeClass();
        next.removeClass();
        getpagenum(1);
        newlast(1);
        newnext(3);
    }else if(num == pagecount-1){
        last.removeClass();
        next.removeClass();
        if(pagecount<=5){
            getpagenum(1);
        }else{
            getpagenum(pagecount-4)
        }
        newlast(num-1);
        newnext(pagecount);
    }else{
        last.removeClass();
        next.removeClass();
        if(pagecount<=5){
            getpagenum(1);
        }else{
            getpagenum(num-2);
        }
        newlast(num-1);
        newnext(num+1);
    }
    function getpagenum(start){
        var pagenum = start;
        var html = '';
        for(var i =0;i<5;i++){
            if(pagenum==num){
                pagearr[i].removeClass();
                pagearr[i].addClass('active');
                html = '<a>'+pagenum+'</a>';
            }else{
                pagearr[i].removeClass();
                html = '<a onclick="pageing('+pagenum+')" href="javascript:void(0)">'+pagenum+'</a>';
            }
            pagearr[i].html(html);
            pagenum++;
        }
    }
    function newnext(pagenum){
        next.empty();
        if(pagenum==0) {
            next.html('<a>&raquo;</a>');
        }else{
            next.html('<a onclick="pageing('+pagenum+')" href="javascript:void(0)">&raquo;</a>');
        }
    }
    function newlast(pagenum){
        last.empty();
        if(pagenum==0) {
            last.html('<a>&laquo;</a>');
        }else{
            last.html('<a onclick="pageing('+pagenum+')" href="javascript:void(0)">&laquo;</a>');
        }
    }
}
//加载阅读历史
function infomarks(){}
//加载章节数
function infoSecs(){}
//下载地址
function infodownload(){}